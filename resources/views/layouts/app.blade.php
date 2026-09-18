<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @hasSection('title')
        @yield('title')
        @else
        Mairie de Veckersviller | Site officiel
        @endif
    </title>

    <meta
        name="description"
        content="@hasSection('description')
        @yield('description')
    @else
        Site officiel de la mairie de Veckersviller en Moselle : actualités, informations pratiques, horaires et documents municipaux.
    @endif">

    <link
        rel="canonical"
        href="{{ $canonical ?? url()->current() }}">

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Mairie de Veckersviller" />
    <link rel="manifest" href="/site.webmanifest" />

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