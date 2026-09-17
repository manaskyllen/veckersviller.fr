@props([
'temperature' => null,
'apparentTemperature' => null,
'humidity' => null,
'windSpeed' => null,
'description' => null,
'icon' => null,
])

<div class="rounded-2xl bg-primary-950 p-6 text-white">

    <div class="flex items-start justify-between gap-4">

        <div>
            <p class="text-sm font-medium text-primary-200">
                Météo à Veckersviller
            </p>

            @if ($temperature !== null)
            <p class="mt-3 text-4xl font-semibold tracking-tight">
                {{ $temperature }}°
            </p>
            @else
            <p class="mt-3 text-2xl font-semibold tracking-tight">
                —
            </p>
            @endif

            @if ($description)
            <p class="mt-1 text-sm text-primary-200">
                {{ $description }}
            </p>
            @endif
        </div>

        <div class="flex size-14 items-center justify-center">
            <x-weather.icon
                :name="$icon ?? 'sun'"
                class="size-12 text-primary-100" />
        </div>

    </div>

    <div class="mt-6 flex items-center pt-5">

        <div class="flex-1 pr-4">
            <p class="text-xs text-primary-300">
                Ressenti
            </p>

            <p class="mt-1 text-sm font-medium">
                {{ $apparentTemperature !== null ? $apparentTemperature . '°' : '—' }}
            </p>
        </div>

        <div class="flex-1 px-4">
            <p class="text-xs text-primary-300">
                Vent
            </p>

            <p class="mt-1 text-sm font-medium">
                {{ $windSpeed !== null ? $windSpeed . ' km/h' : '—' }}
            </p>
        </div>

        <div class="flex-1 pl-4">
            <p class="text-xs text-primary-300">
                Humidité
            </p>

            <p class="mt-1 text-sm font-medium">
                {{ $humidity !== null ? $humidity . ' %' : '—' }}
            </p>
        </div>

    </div>

</div>