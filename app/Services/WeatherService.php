<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    private const LATITUDE = 48.8417;

    private const LONGITUDE = 7.1806;

    public function getWeather(): array
    {
        return Cache::remember(
            'weather.veckersviller',
            now()->addHour(),
            function (): array {
                $data = Http::timeout(5)
                    ->get('https://api.open-meteo.com/v1/forecast', [
                        'latitude' => self::LATITUDE,
                        'longitude' => self::LONGITUDE,
                        'current' => implode(',', [
                            'temperature_2m',
                            'apparent_temperature',
                            'relative_humidity_2m',
                            'weather_code',
                            'wind_speed_10m',
                            'is_day',
                        ]),
                        'timezone' => 'Europe/Paris',
                    ])
                    ->throw()
                    ->json();

                $weatherCode = (int) $data['current']['weather_code'];

                $isDay = (bool) $data['current']['is_day'];

                return [
                    'temperature' => round(
                        $data['current']['temperature_2m']
                    ),
                    'apparent_temperature' => round(
                        $data['current']['apparent_temperature']
                    ),
                    'humidity' => round(
                        $data['current']['relative_humidity_2m']
                    ),
                    'description' => $this->getDescription($weatherCode),
                    'icon' => $this->getIcon($weatherCode, $isDay),
                    'wind_speed' => round(
                        $data['current']['wind_speed_10m']
                    ),
                ];
            },
        );
    }

    private function getDescription(int $code): string
    {
        return match (true) {
            $code === 0 => 'Ciel dégagé',

            in_array($code, [1, 2], true)
            => 'Partiellement nuageux',

            $code === 3
            => 'Couvert',

            in_array($code, [45, 48], true)
            => 'Brouillard',

            in_array($code, [51, 53, 55, 56, 57], true)
            => 'Bruine',

            in_array($code, [61, 63, 65, 66, 67], true)
            => 'Pluie',

            in_array($code, [71, 73, 75, 77], true)
            => 'Neige',

            in_array($code, [80, 81, 82], true)
            => 'Averses',

            in_array($code, [85, 86], true)
            => 'Averses de neige',

            in_array($code, [95, 96, 99], true)
            => 'Orage',

            default => 'Conditions variables',
        };
    }

    private function getIcon(int $code, bool $isDay): string
    {
        return match (true) {
            $code === 0
            => $isDay ? 'sun' : 'moon',

            in_array($code, [1, 2], true)
            => $isDay ? 'partly-cloudy' : 'partly-cloudy-night',

            $code === 3
            => 'cloudy',

            in_array($code, [45, 48], true)
            => 'fog',

            in_array($code, [51, 53, 55, 56, 57], true)
            => 'drizzle',

            in_array($code, [61, 63, 65, 66, 67], true)
            => 'rain',

            in_array($code, [71, 73, 75, 77, 85, 86], true)
            => 'snow',

            in_array($code, [80, 81, 82], true)
            => 'showers',

            in_array($code, [95, 96, 99], true)
            => 'storm',

            default
            => $isDay ? 'sun' : 'moon',
        };
    }
}
