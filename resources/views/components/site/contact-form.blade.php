{{-- Formulaire --}}
<div class="rounded-2xl border border-stone-200 bg-white p-6 sm:p-8">

    <div class="mb-8">
        <h2 class="text-2xl font-semibold tracking-tight text-primary-950">
            Envoyer un message
        </h2>

        <p class="mt-2 text-sm text-stone-600">
            Les champs marqués d'un
            <span class="text-red-600">*</span>
            sont obligatoires.
        </p>
    </div>

    {{-- Succès --}}
    @if (session('success'))
    <div
        class="mb-8 flex gap-4 rounded-xl border border-green-200 bg-green-50 p-4"
        role="alert">
        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-700">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-5 w-5"
                aria-hidden="true">
                <path
                    fill-rule="evenodd"
                    d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-7.5 9.5a.75.75 0 0 1-1.127.075l-4-4.5a.75.75 0 1 1 1.12-1.006l3.405 3.83 6.99-8.853a.75.75 0 0 1 1.052-.098l-.083-.075Z"
                    clip-rule="evenodd" />
            </svg>
        </div>

        <div>
            <p class="font-medium leading-9 text-green-900">
                Message envoyé
            </p>

            <p class="mt-1 text-sm leading-6 text-green-800">
                {{ session('success') }}
            </p>
        </div>
    </div>
    @endif

    <form
        method="POST"
        action="{{ route('contact.store') }}"
        class="space-y-6">

        @csrf


        {{-- Nom / prénom --}}
        <div class="grid gap-6 sm:grid-cols-2">

            {{-- Prénom --}}
            <div>
                <label
                    for="first_name"
                    class="block text-sm font-medium text-primary-950">
                    Prénom
                    <span class="text-red-600">*</span>
                </label>

                <input
                    id="first_name"
                    name="first_name"
                    type="text"
                    value="{{ old('first_name') }}"
                    autocomplete="given-name"
                    required
                    class="mt-2 block w-full rounded-lg border px-3 py-2.5 text-sm text-stone-900 shadow-sm outline-none transition
                        placeholder:text-stone-400
                        focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20
                        @error('first_name')
                            border-red-400 bg-red-50/30 focus:border-red-500 focus:ring-red-500/20
                        @else
                            border-stone-300
                        @enderror">

                @error('first_name')
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="mt-0.5 h-4 w-4 shrink-0"
                    aria-hidden="true">
                    <path
                        fill-rule="evenodd"
                        d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM10 5.75a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0V6.5a.75.75 0 0 1 .75-.75Zm0 8a.875.875 0 1 0 0-1.75.875.875 0 0 0 0 1.75Z"
                        clip-rule="evenodd" />
                </svg>

                <span>{{ $message }}</span>
                </p>
                @enderror
            </div>


            {{-- Nom --}}
            <div>
                <label
                    for="last_name"
                    class="block text-sm font-medium text-primary-950">
                    Nom
                    <span class="text-red-600">*</span>
                </label>

                <input
                    id="last_name"
                    name="last_name"
                    type="text"
                    value="{{ old('last_name') }}"
                    autocomplete="family-name"
                    required
                    class="mt-2 block w-full rounded-lg border px-3 py-2.5 text-sm text-stone-900 shadow-sm outline-none transition
                        placeholder:text-stone-400
                        focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20
                        @error('last_name')
                            border-red-400 bg-red-50/30 focus:border-red-500 focus:ring-red-500/20
                        @else
                            border-stone-300
                        @enderror">

                @error('last_name')
                <p class="mt-1.5 flex items-start gap-1.5 text-sm text-red-600">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="mt-0.5 h-4 w-4 shrink-0"
                        aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM10 5.75a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0V6.5a.75.75 0 0 1 .75-.75Zm0 8a.875.875 0 1 0 0-1.75.875.875 0 0 0 0 1.75Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span>{{ $message }}</span>
                </p>
                @enderror
            </div>

        </div>


        {{-- Email / téléphone --}}
        <div class="grid gap-6 sm:grid-cols-2">

            {{-- Email --}}
            <div>
                <label
                    for="email"
                    class="block text-sm font-medium text-primary-950">
                    Adresse e-mail
                    <span class="text-red-600">*</span>
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                    class="mt-2 block w-full rounded-lg border px-3 py-2.5 text-sm text-stone-900 shadow-sm outline-none transition
                        placeholder:text-stone-400
                        focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20
                        @error('email')
                            border-red-400 bg-red-50/30 focus:border-red-500 focus:ring-red-500/20
                        @else
                            border-stone-300
                        @enderror">

                @error('email')
                <p class="mt-1.5 flex items-start gap-1.5 text-sm text-red-600">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="mt-0.5 h-4 w-4 shrink-0"
                        aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM10 5.75a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0V6.5a.75.75 0 0 1 .75-.75Zm0 8a.875.875 0 1 0 0-1.75.875.875 0 0 0 0 1.75Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span>{{ $message }}</span>
                </p>
                @enderror
            </div>


            {{-- Téléphone --}}
            <div>
                <label
                    for="phone"
                    class="block text-sm font-medium text-primary-950">
                    Téléphone
                    <span class="text-stone-400">(facultatif)</span>
                </label>

                <input
                    id="phone"
                    name="phone"
                    type="tel"
                    value="{{ old('phone') }}"
                    autocomplete="tel"
                    class="mt-2 block w-full rounded-lg border px-3 py-2.5 text-sm text-stone-900 shadow-sm outline-none transition
                        placeholder:text-stone-400
                        focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20
                        @error('phone')
                            border-red-400 bg-red-50/30 focus:border-red-500 focus:ring-red-500/20
                        @else
                            border-stone-300
                        @enderror">

                @error('phone')
                <p class="mt-1.5 flex items-start gap-1.5 text-sm text-red-600">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="mt-0.5 h-4 w-4 shrink-0"
                        aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM10 5.75a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0V6.5a.75.75 0 0 1 .75-.75Zm0 8a.875.875 0 1 0 0-1.75.875.875 0 0 0 0 1.75Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span>{{ $message }}</span>
                </p>
                @enderror
            </div>

        </div>


        {{-- Objet --}}
        <div>
            <label
                for="subject"
                class="block text-sm font-medium text-primary-950">
                Objet
                <span class="text-red-600">*</span>
            </label>

            <input
                id="subject"
                name="subject"
                type="text"
                value="{{ old('subject') }}"
                required
                class="mt-2 block w-full rounded-lg border px-3 py-2.5 text-sm text-stone-900 shadow-sm outline-none transition
                    placeholder:text-stone-400
                    focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20
                    @error('subject')
                        border-red-400 bg-red-50/30 focus:border-red-500 focus:ring-red-500/20
                    @else
                        border-stone-300
                    @enderror">

            @error('subject')
            <p class="mt-1.5 text-sm text-red-600">
                <span class="inline-flex items-center gap-1.5">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="h-4 w-4 shrink-0"
                        aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM10 5.75a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0V6.5a.75.75 0 0 1 .75-.75Zm0 8a.875.875 0 1 0 0-1.75.875 .875 0 0 0 0 1.75Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span>{{ $message }}</span>
                </span>
            </p>
            @enderror
        </div>


        {{-- Message --}}
        <div>
            <label
                for="message"
                class="block text-sm font-medium text-primary-950">
                Message
                <span class="text-red-600">*</span>
            </label>

            <textarea
                id="message"
                name="message"
                rows="7"
                required
                class="mt-2 block w-full resize-y rounded-lg border px-3 py-2.5 text-sm text-stone-900 shadow-sm outline-none transition
                    placeholder:text-stone-400
                    focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20
                    @error('message')
                        border-red-400 bg-red-50/30 focus:border-red-500 focus:ring-red-500/20
                    @else
                        border-stone-300
                    @enderror">{{ old('message') }}</textarea>

            @error('message')
            <p class="mt-1.5 text-sm text-red-600">
                <span class="inline-flex items-center gap-1.5">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="h-4 w-4 shrink-0"
                        aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM10 5.75a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0V6.5a.75.75 0 0 1 .75-.75Zm0 8a.875.875 0 1 0 0-1.75.875 .875 0 0 0 0 1.75Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span>{{ $message }}</span>
                </span>
            </p>
            @enderror
        </div>


        {{-- Confidentialité --}}
        <div>
            <label class="flex items-start gap-3">
                <input
                    type="checkbox"
                    name="privacy"
                    value="1"
                    @checked(old('privacy'))
                    required
                    class="mt-1 h-4 w-4 rounded border-stone-300 text-primary-700 focus:ring-2 focus:ring-primary-600/20">

                <span class="text-sm leading-6 text-stone-600">
                    J'accepte que les informations saisies dans ce formulaire
                    soient utilisées par la mairie afin de répondre à ma demande.
                    <span class="text-red-600">*</span>
                </span>
            </label>

            @error('privacy')
            <p class="mt-1.5 flex items-start gap-1.5 text-sm text-red-600">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="mt-0.5 h-4 w-4 shrink-0"
                    aria-hidden="true">
                    <path
                        fill-rule="evenodd"
                        d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM10 5.75a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0V6.5a.75.75 0 0 1 .75-.75Zm0 8a.875.875 0 1 0 0-1.75.875.875 0 0 0 0 1.75Z"
                        clip-rule="evenodd" />
                </svg>

                <span>{{ $message }}</span>
            </p>
            @enderror
        </div>


        {{-- Action --}}
        <div class="pt-2">
            <button
                type="submit"
                class="rounded-lg bg-primary-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition
                    hover:bg-primary-800
                    focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
                Envoyer le message
            </button>
        </div>

    </form>

</div>