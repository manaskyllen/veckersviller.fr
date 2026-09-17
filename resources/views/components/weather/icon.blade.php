@props([
'name' => 'sun',
])

@php
$icons = [
'sun' => '
<circle cx="12" cy="12" r="4" />
<path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
',

'partly-cloudy' => '
<path d="M8 17h9a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 7 10.5c0 .17.01.34.02.5A3 3 0 0 0 8 17Z" />
<path d="M7 6V4M3.46 7.46l1.42-1.42M3 11H1M10.54 7.46l1.42-1.42" />
',

'cloudy' => '
<path d="M6 18h11a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 7 11.5c0 .17.01.34.02.5A3 3 0 0 0 6 18Z" />
',

'fog' => '
<path d="M4 9h16M3 13h18M5 17h14" />
',

'drizzle' => '
<path d="M6 13h11a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 7 6.5c0 .17.01.34.02.5A3 3 0 0 0 6 13Z" />
<path d="M8 17v1M12 17v1M16 17v1" />
',

'rain' => '
<path d="M6 13h11a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 7 6.5c0 .17.01.34.02.5A3 3 0 0 0 6 13Z" />
<path d="m8 17-1 3M12 17l-1 3M16 17l-1 3" />
',

'snow' => '
<path d="M6 12h11a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 7 5.5c0 .17.01.34.02.5A3 3 0 0 0 6 12Z" />
<path d="M9 16v4M7.3 17l3.4 2M10.7 17l-3.4 2M15 16v4M13.3 17l3.4 2M16.7 17l-3.4 2" />
',

'showers' => '
<path d="M6 12h11a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 7 5.5c0 .17.01.34.02.5A3 3 0 0 0 6 12Z" />
<path d="M8 16v2M12 16v2M16 16v2" />
',

'storm' => '
<path d="M6 12h11a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 7 5.5c0 .17.01.34.02.5A3 3 0 0 0 6 12Z" />
<path d="m13 14-3 5h3l-1 4 4-6h-3l2-3Z" />
',
];

$path = $icons[$name] ?? $icons['sun'];
@endphp

<svg
    {{ $attributes->merge([
        'viewBox' => '0 0 24 24',
        'fill' => 'none',
        'stroke' => 'currentColor',
        'stroke-width' => '1.7',
        'stroke-linecap' => 'round',
        'stroke-linejoin' => 'round',
        'aria-hidden' => 'true',
    ]) }}>
    {!! $path !!}
</svg>