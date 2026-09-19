@extends('layouts.app')

@section('title', 'Contact | Mairie de Veckersviller')

@section('description', 'Contactez la mairie de Veckersviller pour toute question, demande ou information concernant la commune et ses services municipaux.')

@section('content')

{{-- En-tête --}}
<section class="border-b border-stone-200 bg-white">

    <x-site.container class="py-16 sm:py-20">

        <p class="animate-hero text-sm font-semibold uppercase tracking-[0.2em] text-accent-600">
            Mairie de Veckersviller
        </p>

        <h1 class="animate-hero-delay-1 mt-3 text-4xl font-semibold tracking-tight text-primary-950 sm:text-5xl">
            Contact
        </h1>

        <p class="animate-hero-delay-2 mt-5 max-w-2xl text-lg leading-8 text-stone-600">
            Une question, une demande ou besoin d'une information ?
            Contactez la mairie à l'aide du formulaire ci-dessous.
        </p>

    </x-site.container>

</section>


{{-- Contact --}}
<section class="bg-stone-50">

    <x-site.container class="py-12 sm:py-16">

        <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr]">

            {{-- Informations --}}
            <div
                data-reveal="left"
                class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <p class="text-sm font-semibold uppercase tracking-[0.15em] text-accent-600">
                    Nous contacter
                </p>

                <h2 class="mt-3 text-2xl font-semibold tracking-tight text-primary-950">
                    La mairie à votre écoute
                </h2>

                <p class="mt-4 text-sm leading-6 text-stone-600">
                    Pour toute question concernant la commune, les démarches
                    administratives ou la vie municipale, vous pouvez contacter
                    directement la mairie.
                </p>


                <div class="mt-8 space-y-6">

                    {{-- Adresse --}}
                    <div class="flex gap-4">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary-50 text-primary-800">

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                aria-hidden="true">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 21s7-6.2 7-12a7 7 0 10-14 0c0 5.8 7 12 7 12z" />
                                <circle cx="12" cy="9" r="2.5" />
                            </svg>

                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-primary-950">
                                Adresse
                            </h3>

                            <address class="mt-1 not-italic text-sm leading-6 text-stone-600">
                                {{ $municipality->address }}<br>
                                {{ $municipality->postal_code }}
                                {{ $municipality->city }}
                            </address>

                            <a
                                href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($municipality->address . ', ' . $municipality->postal_code . ' ' . $municipality->city) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-2 inline-block text-sm font-semibold text-primary-800 transition hover:text-primary-600">
                                Voir l’itinéraire
                                <span aria-hidden="true">→</span>
                            </a>

                        </div>

                    </div>


                    {{-- Téléphone --}}
                    <div class="flex gap-4">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary-50 text-primary-800">

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                aria-hidden="true">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 5.5A2.5 2.5 0 015.5 3H7l2 5-2 1.5a14 14 0 006 6L14.5 13l5 2v1.5a2.5 2.5 0 01-2.5 2.5C10.37 19 5 13.63 5 7.5A2.5 2.5 0 013 5.5z" />
                            </svg>

                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-primary-950">
                                Téléphone
                            </h3>

                            <a
                                href="tel:{{ preg_replace('/\s+/', '', $municipality->contact_phone) }}"
                                class="mt-1 block text-sm text-stone-600 transition hover:text-primary-700">
                                {{ $municipality->contact_phone }}
                            </a>

                        </div>

                    </div>


                    {{-- E-mail --}}
                    <div class="flex gap-4">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary-50 text-primary-800">

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                aria-hidden="true">
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2" />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 7l9 6 9-6" />
                            </svg>

                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-primary-950">
                                E-mail
                            </h3>

                            <a
                                href="mailto:{{ $municipality->contact_email }}"
                                class="mt-1 block text-sm text-stone-600 transition hover:text-primary-700">
                                {{ $municipality->contact_email }}
                            </a>

                        </div>

                    </div>


                    {{-- Horaires --}}
                    <div class="flex gap-4">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary-50 text-primary-800">

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                aria-hidden="true">
                                <circle cx="12" cy="12" r="9" />
                                <path
                                    stroke-linecap="round"
                                    d="M12 7v5l3 2" />
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <h3 class="text-sm font-semibold text-primary-950">
                                Horaires d'ouverture
                            </h3>

                            <div class="mt-1 space-y-1 text-sm leading-6 text-stone-600">

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

                                    <div class="text-right">

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

                    </div>

                </div>

            </div>

            <div data-reveal="right">
                <x-site.contact-form />
            </div>

        </div>

    </x-site.container>

</section>

@endsection