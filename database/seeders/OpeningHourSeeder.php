<?php

namespace Database\Seeders;

use App\Models\OpeningHour;
use Illuminate\Database\Seeder;

class OpeningHourSeeder extends Seeder
{
    public function run(): void
    {
        $hours = [
            1 => [
                'is_open' => false,
                'morning_open' => null,
                'morning_close' => null,
                'afternoon_open' => null,
                'afternoon_close' => null,
            ],

            2 => [
                'is_open' => true,
                'morning_open' => null,
                'morning_close' => null,
                'afternoon_open' => '17:30',
                'afternoon_close' => '19:30',
            ],

            3 => [
                'is_open' => false,
                'morning_open' => null,
                'morning_close' => null,
                'afternoon_open' => null,
                'afternoon_close' => null,
            ],

            4 => [
                'is_open' => false,
                'morning_open' => null,
                'morning_close' => null,
                'afternoon_open' => null,
                'afternoon_close' => null,
            ],

            5 => [
                'is_open' => true,
                'morning_open' => null,
                'morning_close' => null,
                'afternoon_open' => '16:00',
                'afternoon_close' => '18:00',
            ],

            6 => [
                'is_open' => false,
                'morning_open' => null,
                'morning_close' => null,
                'afternoon_open' => null,
                'afternoon_close' => null,
            ],

            7 => [
                'is_open' => false,
                'morning_open' => null,
                'morning_close' => null,
                'afternoon_open' => null,
                'afternoon_close' => null,
            ],
        ];

        foreach ($hours as $dayOfWeek => $data) {
            OpeningHour::create([
                'day_of_week' => $dayOfWeek,
                ...$data,
            ]);
        }
    }
}
