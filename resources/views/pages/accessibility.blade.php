@extends('layouts.app')

@section('title', 'Accessibilité | Mairie de Veckersviller')

@section('description', 'Consultez les informations relatives à l\'accessibilité du site officiel de la commune de Veckersviller, incluant notre engagement, l\'état d\'accessibilité et les principes appliqués.')

@section('content')

{{-- En-tête --}}
<section class="border-b border-stone-200 bg-white">

    <x-site.container class="py-16 sm:py-20">

        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-600">
            Accessibilité
        </p>

        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-primary-950 sm:text-5xl">
            Accessibilité
        </h1>

        <p class="mt-5 max-w-2xl text-lg leading-8 text-stone-600">
            Informations relatives à l'accessibilité du site de la commune de Veckersviller.
        </p>

    </x-site.container>

</section>


{{-- Contenu --}}
<section class="bg-stone-50">

    <x-site.container class="py-12 sm:py-16">

        <div class="mx-auto max-w-4xl space-y-10">

            {{-- Engagement --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Notre engagement
                </h2>

                <p class="mt-4 text-sm leading-7 text-stone-600">
                    La commune de Veckersviller s'efforce de rendre son site internet
                    accessible au plus grand nombre, notamment aux personnes en situation
                    de handicap.
                </p>

                <p class="mt-4 text-sm leading-7 text-stone-600">
                    Le site est conçu afin de faciliter la navigation, la consultation
                    des contenus et l'accès aux informations essentielles, quel que soit
                    le mode de consultation utilisé.
                </p>

            </section>


            {{-- État --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    État d'accessibilité
                </h2>

                <p class="mt-4 text-sm leading-7 text-stone-600">
                    Le niveau d'accessibilité du site n'a pas encore fait l'objet
                    d'un audit complet permettant d'établir sa conformité à l'ensemble
                    des critères du référentiel applicable.
                </p>

                <p class="mt-4 text-sm leading-7 text-stone-600">
                    Des améliorations sont progressivement apportées afin de faciliter
                    l'utilisation du site par tous les visiteurs.
                </p>

            </section>


            {{-- Principes --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Principes d'accessibilité
                </h2>

                <div class="mt-5 grid gap-4 sm:grid-cols-2">

                    <div class="rounded-xl bg-stone-50 p-5">
                        <h3 class="font-semibold text-primary-950">
                            Navigation
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-stone-600">
                            Une navigation claire et cohérente est proposée sur l'ensemble
                            du site.
                        </p>
                    </div>

                    <div class="rounded-xl bg-stone-50 p-5">
                        <h3 class="font-semibold text-primary-950">
                            Contrastes
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-stone-600">
                            Les couleurs et contrastes sont choisis afin de faciliter
                            la lecture des contenus.
                        </p>
                    </div>

                    <div class="rounded-xl bg-stone-50 p-5">
                        <h3 class="font-semibold text-primary-950">
                            Clavier
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-stone-600">
                            Les principaux éléments interactifs sont conçus pour pouvoir
                            être utilisés au clavier.
                        </p>
                    </div>

                    <div class="rounded-xl bg-stone-50 p-5">
                        <h3 class="font-semibold text-primary-950">
                            Alternatives textuelles
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-stone-600">
                            Les images utiles à la compréhension du contenu sont accompagnées
                            d'alternatives textuelles lorsque cela est nécessaire.
                        </p>
                    </div>

                </div>

            </section>


            {{-- Difficultés --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Signaler une difficulté
                </h2>

                <div class="mt-4 space-y-4 text-sm leading-7 text-stone-600">

                    <p>
                        Si vous rencontrez un problème d'accessibilité qui vous empêche
                        d'accéder à une information ou d'utiliser une fonctionnalité du site,
                        vous pouvez nous contacter afin que nous puissions vous proposer
                        une solution adaptée.
                    </p>

                    <p>
                        Vous pouvez utiliser notre
                        <a
                            href="{{ route('contact') }}"
                            class="text-primary-800 underline decoration-stone-300 underline-offset-2 hover:text-primary-950">
                            formulaire de contact
                        </a>
                        ou contacter directement la mairie aux coordonnées indiquées
                        sur le site.
                    </p>

                </div>

            </section>


            {{-- Référentiel --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Référentiel d'accessibilité
                </h2>

                <p class="mt-4 text-sm leading-7 text-stone-600">
                    Les recommandations d'accessibilité du site s'appuient notamment
                    sur les principes du Référentiel général d'amélioration de
                    l'accessibilité (RGAA).
                </p>

            </section>


            {{-- Liens --}}
            <div class="flex flex-wrap gap-x-6 gap-y-3 border-t border-stone-200 pt-6 text-sm">

                <a
                    href="{{ route('legal') }}"
                    class="text-primary-800 underline decoration-stone-300 underline-offset-4 hover:text-primary-950">
                    Mentions légales
                </a>

                <a
                    href="{{ route('privacy') }}"
                    class="text-primary-800 underline decoration-stone-300 underline-offset-4 hover:text-primary-950">
                    Données personnelles
                </a>

            </div>

        </div>

    </x-site.container>

</section>

@endsection