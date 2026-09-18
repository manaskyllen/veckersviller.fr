@extends('layouts.app')

@section('title', 'Mentions légales | Mairie de Veckersviller')

@section('description', 'Consultez les mentions légales du site officiel de la commune de Veckersviller, incluant les informations sur l\'éditeur, l\'hébergement et la propriété intellectuelle.')

@section('content')

{{-- En-tête --}}
<section class="border-b border-stone-200 bg-white">

    <x-site.container class="py-16 sm:py-20">

        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-600">
            Informations
        </p>

        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-primary-950 sm:text-5xl">
            Mentions légales
        </h1>

        <p class="mt-5 max-w-2xl text-lg leading-8 text-stone-600">
            Informations relatives à l'éditeur et à l'utilisation du site de la commune de Veckersviller.
        </p>

    </x-site.container>

</section>


{{-- Contenu --}}
<section class="bg-stone-50">

    <x-site.container class="py-12 sm:py-16">

        <div class="mx-auto max-w-4xl space-y-10">

            {{-- Éditeur --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Éditeur du site
                </h2>

                <div class="mt-5 space-y-2 text-sm leading-7 text-stone-600">

                    <p>
                        <strong class="font-medium text-primary-950">
                            Commune de Veckersviller
                        </strong>
                    </p>

                    <p>
                        {{ $municipality->address }}<br>
                        {{ $municipality->postal_code }}
                        {{ $municipality->city }}
                    </p>

                    @if ($municipality->contact_phone)
                    <p>
                        Téléphone :
                        <a
                            href="tel:{{ preg_replace('/\s+/', '', $municipality->contact_phone) }}"
                            class="text-primary-800 underline decoration-stone-300 underline-offset-2 hover:text-primary-950">
                            {{ $municipality->contact_phone }}
                        </a>
                    </p>
                    @endif

                    @if ($municipality->contact_email)
                    <p>
                        E-mail :
                        <a
                            href="mailto:{{ $municipality->contact_email }}"
                            class="text-primary-800 underline decoration-stone-300 underline-offset-2 hover:text-primary-950">
                            {{ $municipality->contact_email }}
                        </a>
                    </p>
                    @endif

                </div>

            </section>


            {{-- Responsable de publication --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Responsable de la publication
                </h2>

                <p class="mt-4 text-sm leading-7 text-stone-600">
                    Le responsable de la publication du site est le représentant légal
                    de la commune de Veckersviller.
                </p>

            </section>


            {{-- Hébergement --}}
            {{-- Hébergement --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Hébergement
                </h2>

                <div class="mt-4 text-sm leading-7 text-stone-600">

                    <p class="font-medium text-primary-950">
                        OVHcloud
                    </p>

                    <p>
                        OVH SAS<br>
                        2 rue Kellermann<br>
                        59100 Roubaix<br>
                        France
                    </p>

                    <p class="mt-3">
                        Téléphone :
                        <a
                            href="tel:+33972101007"
                            class="text-primary-800 underline decoration-stone-300 underline-offset-2 hover:text-primary-950">
                            09 72 10 10 07
                        </a>
                    </p>

                    <p>
                        Site :
                        <a
                            href="https://www.ovhcloud.com/"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-primary-800 underline decoration-stone-300 underline-offset-2 hover:text-primary-950">
                            ovhcloud.com
                        </a>
                    </p>

                </div>

            </section>


            {{-- Propriété intellectuelle --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Propriété intellectuelle
                </h2>

                <div class="mt-4 space-y-4 text-sm leading-7 text-stone-600">

                    <p>
                        L'ensemble des contenus présents sur ce site, notamment les textes,
                        images, photographies, documents et éléments graphiques, est protégé
                        par les dispositions applicables en matière de propriété intellectuelle,
                        sauf mention contraire.
                    </p>

                    <p>
                        Toute reproduction, représentation, modification ou réutilisation
                        de tout ou partie du site ou de ses contenus doit respecter les droits
                        applicables et les éventuelles conditions particulières indiquées
                        sur les contenus concernés.
                    </p>

                </div>

            </section>


            {{-- Responsabilité --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Responsabilité
                </h2>

                <p class="mt-4 text-sm leading-7 text-stone-600">
                    La commune de Veckersviller s'efforce de maintenir les informations
                    publiées sur ce site à jour et exactes. Toutefois, elle ne peut garantir
                    l'exhaustivité ou l'absence d'erreur dans l'ensemble des contenus publiés.
                </p>

            </section>


            {{-- Liens --}}
            <div class="flex flex-wrap gap-x-6 gap-y-3 border-t border-stone-200 pt-6 text-sm">

                <a
                    href="{{ route('privacy') }}"
                    class="text-primary-800 underline decoration-stone-300 underline-offset-4 hover:text-primary-950">
                    Données personnelles
                </a>

                <a
                    href="{{ route('accessibility') }}"
                    class="text-primary-800 underline decoration-stone-300 underline-offset-4 hover:text-primary-950">
                    Accessibilité
                </a>

            </div>

        </div>

    </x-site.container>

</section>

@endsection