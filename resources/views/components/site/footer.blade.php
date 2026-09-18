<footer class="border-t border-stone-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

        <div class="grid gap-10 md:grid-cols-3">

            {{-- Identité --}}
            <div>
                <div class="flex items-center gap-3">
                    <div
                        class="flex items-center justify-center rounded-xl text-sm font-bold text-white"
                        aria-hidden="true">
                        <img
                            src="{{ Storage::url($site->logo_footer) }}"
                            alt="Blason de Veckersviller"
                            class="h-8 w-8" />
                    </div>

                    <div>
                        <p class="font-semibold tracking-tight text-primary-950">
                            Mairie de Veckersviller
                        </p>
                        <p class="text-xs text-stone-500">
                            Commune de Moselle
                        </p>
                    </div>
                </div>

                <p class="mt-4 max-w-sm text-sm leading-6 text-stone-600">
                    Retrouvez les actualités, informations pratiques et
                    documents de la commune de Veckersviller.
                </p>
            </div>

            {{-- Navigation --}}
            <div>
                <h2 class="text-sm font-semibold text-primary-950">
                    Navigation
                </h2>

                <nav
                    class="mt-4 flex flex-col gap-3"
                    aria-label="Navigation secondaire">

                    <a
                        href="{{ route('home') }}"
                        class="w-fit text-sm text-stone-600 transition hover:text-primary-900">
                        Accueil
                    </a>

                    <a
                        href="{{ route('posts.index') }}"
                        class="w-fit text-sm text-stone-600 transition hover:text-primary-900">
                        Actualités
                    </a>

                    <a
                        href="{{ route('documents.index') }}"
                        class="w-fit text-sm text-stone-600 transition hover:text-primary-900">
                        Documents
                    </a>

                    <a
                        href="{{ route('contact') }}"
                        class="w-fit text-sm text-stone-600 transition hover:text-primary-900">
                        Nous contacter
                    </a>
                </nav>
            </div>

            {{-- Mairie --}}
            <div>
                <h2 class="text-sm font-semibold text-primary-950">
                    Mairie
                </h2>

                <div class="mt-4 flex flex-col gap-4 text-sm text-stone-600">

                    <a
                        href="https://www.google.com/maps/search/?api=1&query={{ urlencode($municipality->address . ', ' . $municipality->postal_code . ' ' . $municipality->city) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="group flex items-start gap-3">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            class="mt-0.5 h-5 w-5 shrink-0 text-stone-400 transition group-hover:text-primary-800"
                            aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 10.5-7.5 10.5S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>

                        <span class="leading-6 transition group-hover:text-primary-800">
                            {{ $municipality->address }}<br>
                            {{ $municipality->postal_code }}
                            {{ $municipality->city }}
                        </span>
                    </a>

                    {{-- E-mail --}}
                    <div class="flex items-start gap-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            class="mt-0.5 h-5 w-5 shrink-0 text-stone-400"
                            aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5H4.5a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.69 5.56a1.5 1.5 0 0 1-1.62 0L2.25 6.75" />
                        </svg>

                        <a
                            href="mailto:{{ $municipality->contact_email }}"
                            class="leading-6 transition hover:text-primary-800">
                            {{ $municipality->contact_email }}
                        </a>
                    </div>

                    {{-- Téléphone --}}
                    <div class="flex items-start gap-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="mt-0.5 h-5 w-5 shrink-0 text-stone-400"
                            aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>

                        <a
                            href="tel:{{ preg_replace('/\s+/', '', $municipality->contact_phone) }}"
                            class="leading-6 transition hover:text-primary-800">
                            {{ $municipality->contact_phone }}
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- Liens légaux --}}
        <div
            class="mt-10 flex flex-col gap-4 border-t border-stone-200 pt-6 text-xs text-stone-500 sm:flex-row sm:items-center sm:justify-between">

            <p>
                © {{ date('Y') }} Commune de Veckersviller
            </p>

            <nav
                class="flex flex-wrap gap-x-5 gap-y-2"
                aria-label="Informations légales">

                <a
                    href="{{ route('legal') }}"
                    class="transition hover:text-primary-900">
                    Mentions légales
                </a>

                <a
                    href="{{ route('privacy') }}"
                    class="transition hover:text-primary-900">
                    Données personnelles
                </a>

                <a
                    href="{{ route('accessibility') }}"
                    class="transition hover:text-primary-900">
                    Accessibilité
                </a>

            </nav>

        </div>

    </div>
</footer>