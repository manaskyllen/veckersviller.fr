@props([
'name' => 'sun',
])

@php
$icons = [
'sun' => '
<circle cx="12" cy="12" r="3.5" />
<path d="M12 2.5v2M12 19.5v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42M2.5 12h2M19.5 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42" />
',

'partly-cloudy' => '
<path d="M17 18a4.5 4.5 0 0 0 .5-8.97A5.5 5.5 0 0 0 7 10.5" />
<path d="M7 4v2M3.76 5.76l1.42 1.42M3 10h2" />
<path d="M7 18h10a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 7 11.5a3 3 0 0 0 0 6.5Z" />
',

'cloudy' => '
<path d="M6.5 18h10a4.5 4.5 0 0 0 .5-8.97A5.5 5.5 0 0 0 7 11.5a3 3 0 0 0-.5 6.5Z" />
',

'fog' => '
<path d="M4 9h16" />
<path d="M3 13h18" />
<path d="M5 17h14" />
',

'drizzle' => '
<path d="M6.5 13h10a4.5 4.5 0 0 0 .5-8.97A5.5 5.5 0 0 0 7 6.5a3 3 0 0 0-.5 6.5Z" />
<path d="M8 17v1M12 17v1M16 17v1" />
',

'rain' => '
<path d="M6.5 13h10a4.5 4.5 0 0 0 .5-8.97A5.5 5.5 0 0 0 7 6.5a3 3 0 0 0-.5 6.5Z" />
<path d="m8 17-1 3M12 17l-1 3M16 17l-1 3" />
',

'snow' => '
<path d="M6.5 12h10a4.5 4.5 0 0 0 .5-8.97A5.5 5.5 0 0 0 7 5.5a3 3 0 0 0-.5 6.5Z" />
<path d="M8.5 16v5M6.5 17.5l4 2M10.5 17.5l-4 2" />
<path d="M15.5 16v5M13.5 17.5l4 2M17.5 17.5l-4 2" />
',

'showers' => '
<path d="M6.5 12h10a4.5 4.5 0 0 0 .5-8.97A5.5 5.5 0 0 0 7 5.5a3 3 0 0 0-.5 6.5Z" />
<path d="M8 16v2M12 16v2M16 16v2" />
',

'storm' => '
<path d="M6.5 12h10a4.5 4.5 0 0 0 .5-8.97A5.5 5.5 0 0 0 7 5.5a3 3 0 0 0-.5 6.5Z" />
<path d="m13 14-3 5h3l-1 4 4-6h-3l2-3Z" />
',

'moon' => '
<path d="M20 15.5A8.5 8.5 0 0 1 8.5 4a8.5 8.5 0 1 0 11.5 11.5Z" />
',

'partly-cloudy-night' => '
<path d="M19 14.5A6.5 6.5 0 0 1 10.5 6a6.5 6.5 0 1 0 8.5 8.5Z" />
<path d="M8 18h8a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 6.5 12.5" />
',
];

$path = $icons[$name] ?? $icons['sun'];
@endphp

<svg
    {{ $attributes->merge([
        'viewBox' => '0 0 24 24',
        'fill' => 'none',
        'stroke' => 'currentColor',
        'stroke-width' => '1.8',
        'stroke-linecap' => 'round',
        'stroke-linejoin' => 'round',
        'aria-hidden' => 'true',
    ]) }}>
    {!! $path !!}
</svg>