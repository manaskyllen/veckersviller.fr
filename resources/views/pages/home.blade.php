@extends('layouts.app')

@section('content')

{{-- Hero --}}
<section class="relative overflow-hidden bg-primary-950">

    {{-- Placeholder image --}}
    <div
        class="absolute inset-0 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800"
        aria-hidden="true"></div>

    <div class="relative">
        <x-site.container class="py-24 sm:py-32 lg:py-40">

            <div class="max-w-3xl">

                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-500">
                    Commune de Moselle
                </p>

                <h1 class="mt-4 text-4xl font-semibold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Bienvenue à Veckersviller
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-primary-100 sm:text-xl">
                    Retrouvez les actualités de la commune,
                    les informations pratiques et les documents municipaux.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">

                    <a
                        href="{{ route('posts.index') }}"
                        class="inline-flex items-center rounded-lg bg-white px-5 py-3 text-sm font-semibold text-primary-950 transition hover:bg-stone-100">
                        Voir les actualités

                        <span class="ml-2" aria-hidden="true">
                            →
                        </span>
                    </a>

                    <a
                        href="{{ route('documents.index') }}"
                        class="inline-flex items-center rounded-lg border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/15">
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

                <p class="mt-2 text-sm leading-6 text-stone-600">
                    Retrouvez les horaires d'ouverture et les modalités
                    d'accueil de la mairie.
                </p>

                <div class="mt-5">
                    <span class="text-sm font-semibold text-primary-800">
                        Informations à venir
                    </span>
                </div>

            </div>

            {{-- Contact --}}
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
                    Mairie de Veckersviller<br>
                    Moselle
                </address>

                <div class="mt-5">
                    <a
                        href="#"
                        class="text-sm font-semibold text-primary-800 transition hover:text-primary-600">
                        Voir les coordonnées
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

@endsection