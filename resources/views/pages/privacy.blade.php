@extends('layouts.app')

@section('title', 'Données personnelles | Mairie de Veckersviller')

@section('description', 'Consultez les informations sur la collecte, l\'utilisation et la conservation de vos données personnelles sur le site officiel de la commune de Veckersviller.')

@section('content')

{{-- En-tête --}}
<section class="border-b border-stone-200 bg-white">

    <x-site.container class="py-16 sm:py-20">

        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-600">
            Vie privée
        </p>

        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-primary-950 sm:text-5xl">
            Données personnelles
        </h1>

        <p class="mt-5 max-w-2xl text-lg leading-8 text-stone-600">
            Informations sur la collecte, l'utilisation et la conservation de vos données personnelles.
        </p>

    </x-site.container>

</section>


{{-- Contenu --}}
<section class="bg-stone-50">

    <x-site.container class="py-12 sm:py-16">

        <div class="mx-auto max-w-4xl space-y-10">

            {{-- Responsable --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Responsable du traitement
                </h2>

                <p class="mt-4 text-sm leading-7 text-stone-600">
                    Les traitements de données personnelles réalisés dans le cadre de ce site
                    sont mis en œuvre sous la responsabilité de la commune de Veckersviller.
                </p>

                <div class="mt-4 text-sm leading-7 text-stone-600">

                    <p>
                        {{ $municipality->address }}<br>
                        {{ $municipality->postal_code }}
                        {{ $municipality->city }}
                    </p>

                    @if ($municipality->contact_email)
                    <p class="mt-2">
                        <a
                            href="mailto:{{ $municipality->contact_email }}"
                            class="text-primary-800 underline decoration-stone-300 underline-offset-2 hover:text-primary-950">
                            {{ $municipality->contact_email }}
                        </a>
                    </p>
                    @endif

                </div>

            </section>


            {{-- Formulaire de contact --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Formulaire de contact
                </h2>

                <div class="mt-4 space-y-4 text-sm leading-7 text-stone-600">

                    <p>
                        Lorsque vous utilisez le formulaire de contact, certaines informations
                        personnelles sont collectées afin de permettre à la commune de traiter
                        et de répondre à votre demande.
                    </p>

                    <p>
                        Les données susceptibles d'être collectées comprennent notamment votre
                        nom, votre adresse e-mail, votre numéro de téléphone lorsque celui-ci est
                        renseigné, ainsi que le contenu de votre message.
                    </p>

                    <p>
                        Ces informations sont enregistrées dans un traitement informatisé géré
                        par la commune de Veckersviller.
                    </p>

                </div>

            </section>


            {{-- Utilisation --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Finalité du traitement
                </h2>

                <p class="mt-4 text-sm leading-7 text-stone-600">
                    Les données transmises via le formulaire de contact sont utilisées
                    exclusivement afin de prendre connaissance de votre demande, de la traiter
                    et, lorsque cela est nécessaire, de vous répondre.
                </p>

            </section>


            {{-- Accès --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Destinataires des données
                </h2>

                <div class="mt-4 space-y-4 text-sm leading-7 text-stone-600">

                    <p>
                        Les données sont accessibles uniquement aux personnels habilités de
                        la mairie dans le cadre de leurs fonctions.
                    </p>

                    <p>
                        Les demandes peuvent également être transmises à l'adresse e-mail
                        désignée par la commune afin d'assurer leur traitement.
                    </p>

                </div>

            </section>


            {{-- Conservation --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Durée de conservation
                </h2>

                <p class="mt-4 text-sm leading-7 text-stone-600">
                    Les données transmises via le formulaire de contact sont conservées
                    pendant une durée maximale d'un an à compter de leur enregistrement,
                    sauf obligation légale ou nécessité particulière justifiant une durée
                    de conservation différente.
                </p>

            </section>


            {{-- Droits --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

                <h2 class="text-xl font-semibold text-primary-950">
                    Vos droits
                </h2>

                <div class="mt-4 space-y-4 text-sm leading-7 text-stone-600">

                    <p>
                        Conformément à la réglementation applicable en matière de protection
                        des données personnelles, vous disposez de droits sur vos données,
                        notamment dans les conditions prévues par la réglementation :
                        droit d'accès, de rectification et, selon les cas, d'effacement,
                        de limitation ou d'opposition au traitement.
                    </p>

                    <p>
                        Pour exercer vos droits ou obtenir des informations complémentaires
                        concernant le traitement de vos données, vous pouvez contacter
                        la commune de Veckersviller aux coordonnées indiquées sur ce site.
                    </p>

                    <p>
                        Vous pouvez également, dans les conditions prévues par la réglementation,
                        introduire une réclamation auprès de la
                        <a
                            href="https://www.cnil.fr/"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-primary-800 underline decoration-stone-300 underline-offset-2 hover:text-primary-950">
                            Commission nationale de l'informatique et des libertés (CNIL)
                        </a>.
                    </p>

                </div>

            </section>


            {{-- Liens --}}
            <div class="flex flex-wrap gap-x-6 gap-y-3 border-t border-stone-200 pt-6 text-sm">

                <a
                    href="{{ route('legal') }}"
                    class="text-primary-800 underline decoration-stone-300 underline-offset-4 hover:text-primary-950">
                    Mentions légales
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