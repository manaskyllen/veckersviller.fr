<header class="sticky top-0 z-50 border-b border-stone-200/80 bg-white/95 backdrop-blur">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

        {{-- Logo / identité de la commune --}}
        <a
            href="{{ route('home') }}"
            class="flex items-center gap-3">
            {{-- Placeholder du blason --}}
            <div
                class="flex size-11 items-center justify-center rounded-xl bg-primary-900 text-sm font-bold text-white"
                aria-hidden="true">
                V
            </div>

            <div>
                <div class="text-sm font-semibold tracking-tight text-primary-950">
                    Veckersviller
                </div>

                <div class="text-xs text-stone-500">
                    Commune de Moselle
                </div>
            </div>
        </a>

        {{-- Navigation desktop --}}
        <nav
            class="hidden items-center gap-8 md:flex"
            aria-label="Navigation principale">
            <a
                href="{{ route('home') }}"
                class="text-sm font-medium text-stone-600 transition hover:text-primary-900">
                Accueil
            </a>

            <a
                href="{{ route('posts.index') }}"
                class="text-sm font-medium text-stone-600 transition hover:text-primary-900">
                Actualités
            </a>

            <a
                href="{{ route('documents.index') }}"
                class="text-sm font-medium text-stone-600 transition hover:text-primary-900">
                Documents
            </a>
        </nav>

        {{-- Menu mobile --}}
        <button
            type="button"
            class="flex size-10 items-center justify-center rounded-lg border border-stone-200 text-stone-700 transition hover:bg-stone-50 md:hidden"
            aria-label="Ouvrir le menu"
            aria-expanded="false">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                class="size-5"
                aria-hidden="true">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

    </div>
</header>