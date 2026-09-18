@extends('layouts.app')

@section('content')

{{-- Hero --}}
<section class="relative min-h-[calc(100vh-64px)] overflow-hidden">

    {{-- Image de fond --}}
    <img
        src="{{ Storage::url($site->hero_image) }}"
        alt="Vue de Veckersviller"
        class="absolute inset-0 h-full w-full object-cover object-center" />

    {{-- Dégradé sombre à gauche --}}
    <div
        class="absolute inset-0 bg-gradient-to-r
               from-slate-950/90
               via-slate-950/60
               to-transparent">
    </div>

    {{-- Léger assombrissement en bas --}}
    <div
        class="absolute inset-0 bg-gradient-to-t
               from-slate-950/30
               via-transparent
               to-transparent">
    </div>

    {{-- Contenu --}}
    <div class="relative z-10 min-h-[88vh]">
        <x-site.container class="flex min-h-[88vh] items-center">

            <div class="max-w-2xl">

                {{-- Sur-titre --}}
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-accent-600">
                    Commune de Moselle
                </p>

                {{-- Titre --}}
                <h1 class="mt-5 text-6xl font-bold leading-[1.05] tracking-tight text-white lg:text-7xl">
                    Bienvenue à<br>
                    Veckersviller
                </h1>

                {{-- Description --}}
                <p class="mt-7 max-w-xl text-xl leading-relaxed text-white/90">
                    Retrouvez les actualités de la commune,
                    les informations pratiques et les documents municipaux.
                </p>

                {{-- Boutons --}}
                <div class="mt-10 flex flex-wrap gap-4">

                    <a
                        href="/actualites"
                        class="inline-flex items-center gap-4 rounded-xl bg-white px-8 py-4
                               font-semibold text-slate-900 transition
                               hover:bg-slate-100">
                        Voir les actualités

                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </a>

                    <a
                        href="/documents"
                        class="inline-flex items-center rounded-xl border
                               border-white/40 bg-white/10 px-8 py-4
                               font-semibold text-white backdrop-blur-sm
                               transition hover:bg-white/20">
                        Documents municipaux
                    </a>

                </div>

            </div>

        </x-site.container>
    </div>

</section>

{{-- Informations pratiques --}}
<section class="bg-white">

    <x-site.container class="py-16 sm:py-20">

        <x-site.section-heading
            title="Informations pratiques"
            description="Les informations essentielles pour vos démarches et votre quotidien." />

        <div class="mt-10 grid gap-6 lg:grid-cols-3">

            {{-- Horaires --}}
            <div class="rounded-2xl border border-stone-200 bg-white p-6">

                <div class="flex size-11 items-center justify-center rounded-xl bg-primary-50 text-primary-800">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="size-5"
                        aria-hidden="true">
                        <circle cx="12" cy="12" r="9" />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 7v5l3 2" />
                    </svg>
                </div>

                <h3 class="mt-5 text-lg font-semibold text-primary-950">
                    Horaires de la mairie
                </h3>

                <div class="mt-5 space-y-1 text-sm">

                    @foreach ($openingHours as $openingHour)

                    <div class="flex items-start justify-between gap-4">

                        <span class="font-medium text-primary-950">
                            {{ $openingHour->getDayNameAttribute() }}
                        </span>

                        @if (!$openingHour->is_open)

                        <span class="text-stone-500">
                            Fermé
                        </span>

                        @else

                        <div class="text-right text-stone-600">

                            @if ($openingHour->morning_open && $openingHour->morning_close)
                            <div>
                                {{ \Carbon\Carbon::parse($openingHour->morning_open)->format('H\hi') }}
                                –
                                {{ \Carbon\Carbon::parse($openingHour->morning_close)->format('H\hi') }}
                            </div>
                            @endif

                            @if ($openingHour->afternoon_open && $openingHour->afternoon_close)
                            <div>
                                {{ \Carbon\Carbon::parse($openingHour->afternoon_open)->format('H\hi') }}
                                –
                                {{ \Carbon\Carbon::parse($openingHour->afternoon_close)->format('H\hi') }}
                            </div>
                            @endif

                        </div>

                        @endif

                    </div>

                    @endforeach

                </div>

            </div>

            {{-- Localisation --}}
            <div class="flex flex-col rounded-2xl border border-stone-200 bg-white p-6">

                <div class="flex size-11 items-center justify-center rounded-xl bg-primary-50 text-primary-800">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="size-5"
                        aria-hidden="true">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" />
                        <circle cx="12" cy="10" r="2.5" />
                    </svg>
                </div>

                <h3 class="mt-5 text-lg font-semibold text-primary-950">
                    Nous trouver
                </h3>

                <address class="mt-2 not-italic text-sm leading-6 text-stone-600">
                    Mairie de {{ $municipality->city }}<br>
                    {{ $municipality->address }}<br>
                    {{ $municipality->postal_code }}
                    {{ $municipality->city }}
                </address>

                <div class="mt-auto pt-6">
                    <a
                        href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($municipality->address . ', ' . $municipality->postal_code . ' ' . $municipality->city) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-sm font-semibold text-primary-800 transition hover:text-primary-600">
                        Voir l’itinéraire
                        <span aria-hidden="true">→</span>
                    </a>
                </div>

            </div>

            {{-- Météo --}}
            <x-site.weather-card
                :temperature="$weather['temperature']"
                :apparent-temperature="$weather['apparent_temperature']"
                :humidity="$weather['humidity']"
                :wind-speed="$weather['wind_speed']"
                :description="$weather['description']"
                :icon="$weather['icon']" />

        </div>

    </x-site.container>

</section>

{{-- Actualités --}}
<section class="bg-stone-50">

    <x-site.container class="py-16 sm:py-20">

        <x-site.section-heading
            title="Actualités"
            description="Les dernières informations de la commune de Veckersviller."
            :link="route('posts.index')"
            link-text="Toutes les actualités" />

        @if ($posts->isNotEmpty())

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

            @foreach ($posts as $post)
            <x-site.post-card :post="$post" />
            @endforeach

        </div>

        @else

        <div class="mt-10 rounded-2xl border border-dashed border-stone-300 bg-white p-10 text-center">
            <p class="text-sm text-stone-600">
                Aucune actualité pour le moment.
            </p>
        </div>

        @endif

    </x-site.container>

</section>

{{-- Documents --}}
<section class="bg-primary-50">

    <x-site.container class="py-16 sm:py-20">

        <div class="grid items-center gap-10 lg:grid-cols-[1fr_auto]">

            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-600">
                    Vie municipale
                </p>

                <h2 class="mt-3 text-3xl font-semibold tracking-tight text-primary-950">
                    Documents municipaux
                </h2>

                <p class="mt-4 max-w-2xl text-base leading-7 text-stone-600">
                    Retrouvez facilement les arrêtés, délibérations,
                    procès-verbaux et autres documents publiés par la commune.
                </p>
            </div>

            <a
                href="{{ route('documents.index') }}"
                class="inline-flex items-center justify-center rounded-lg bg-primary-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-primary-800">
                Consulter les documents

                <span class="ml-2" aria-hidden="true">
                    →
                </span>
            </a>

        </div>

    </x-site.container>

</section>

<section class="bg-white" id="contact">
    <x-site.container class="py-16 sm:py-20">
        <x-site.section-heading
            title="Nous contacter"
            description="Une question, une demande ou besoin d'une information ? Contactez la mairie à l'aide du formulaire ci-dessous." />

        <div class="mt-10">
            <x-site.contact-form />
        </div>
    </x-site.container>
</section>

@endsection