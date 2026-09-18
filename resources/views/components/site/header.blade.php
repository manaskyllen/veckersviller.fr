<header class="sticky top-0 z-50 border-b border-stone-200/80 bg-white/95 backdrop-blur">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

        {{-- Logo / identité de la commune --}}
        <a
            href="{{ route('home') }}"
            class="flex items-center gap-4">
            <div
                class="flex items-center justify-center rounded-xl text-sm font-bold text-white"
                aria-hidden="true">
                <img
                    src="{{ Storage::url($site->logo_header) }}"
                    alt="Blason de Veckersviller"
                    class="size-14" />
            </div>

            <div>
                <div class="text-xl font-semibold tracking-tight text-primary-950">
                    Mairie de Veckersviller
                </div>

                <div class="text-sm text-stone-500">
                    Commune de Moselle
                </div>
            </div>
        </a>

        {{-- Navigation desktop --}}
        <nav
            class="hidden items-center gap-8 md:flex"
            aria-label="Navigation principale">

            {{-- Accueil --}}
            <a
                href="{{ route('home') }}"
                @class([ 'py-2 text-sm font-medium transition' , 'border-b-2 border-primary-900 text-primary-900'=> request()->routeIs('home'),
                'text-stone-600 hover:text-primary-900' => !request()->routeIs('home'),
                ])>
                Accueil
            </a>

            {{-- Actualités --}}
            <a
                href="{{ route('posts.index') }}"
                @class([ 'py-2 text-sm font-medium transition' , 'border-b-2 border-primary-900 text-primary-900'=> request()->routeIs('posts.*'),
                'text-stone-600 hover:text-primary-900' => !request()->routeIs('posts.*'),
                ])>
                Actualités
            </a>

            {{-- Documents --}}
            <a
                href="{{ route('documents.index') }}"
                @class([ 'py-2 text-sm font-medium transition' , 'border-b-2 border-primary-900 text-primary-900'=> request()->routeIs('documents.*'),
                'text-stone-600 hover:text-primary-900' => !request()->routeIs('documents.*'),
                ])>
                Documents
            </a>

            {{-- Nous contacter --}}
            <a
                href="{{ route('contact') }}"
                @class([ 'py-2 text-sm font-medium transition' , 'border-b-2 border-primary-900 text-primary-900'=> request()->routeIs('contact'),
                'text-stone-600 hover:text-primary-900' => !request()->routeIs('contact'),
                ])>
                Nous contacter
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