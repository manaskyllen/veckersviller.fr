<footer class="border-t border-stone-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

        <div class="grid gap-10 md:grid-cols-3">

            {{-- Identité --}}
            <div>
                <div class="flex items-center gap-3">
                    <div
                        class="flex size-10 items-center justify-center rounded-lg bg-primary-900 text-sm font-bold text-white"
                        aria-hidden="true">
                        V
                    </div>

                    <div>
                        <p class="font-semibold tracking-tight text-primary-950">
                            Veckersviller
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

                <nav class="mt-4 flex flex-col gap-3" aria-label="Navigation secondaire">
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
                </nav>
            </div>

            {{-- Contact --}}
            <div>
                <h2 class="text-sm font-semibold text-primary-950">
                    Mairie
                </h2>

                <address class="mt-4 not-italic text-sm leading-6 text-stone-600">
                    <p>
                        Veckersviller<br>
                        Moselle
                    </p>

                    <a
                        href="#"
                        class="mt-3 inline-block text-primary-800 transition hover:text-primary-600">
                        Nous contacter
                    </a>
                </address>
            </div>

        </div>

        <div class="mt-10 flex flex-col gap-3 border-t border-stone-200 pt-6 text-xs text-stone-500 sm:flex-row sm:items-center sm:justify-between">

            <p>
                © {{ date('Y') }} Commune de Veckersviller
            </p>

            <p>
                Site officiel de la commune
            </p>

        </div>

    </div>
</footer>