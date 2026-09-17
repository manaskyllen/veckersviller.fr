<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Veckersviller' }}</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js',
    ])
</head>

<body class="min-h-screen bg-stone-50 text-stone-900 antialiased">

    @if ($siteAlert)
    <x-site.alert :alert="$siteAlert" />
    @endif

    <x-site.header />

    <main>
        @yield('content')
    </main>

    <x-site.footer />

</body>

</html>