@props(['post'])

<article
    class="group flex h-full min-h-[440px] flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white transition duration-300 hover:-translate-y-1 hover:shadow-lg">

    {{-- Image --}}
    @if ($post->images->isNotEmpty())

    <a
        href="{{ route('posts.show', $post) }}"
        class="block aspect-[16/10] shrink-0 overflow-hidden bg-stone-100">

        <img
            src="{{ Storage::disk('public')->url($post->images->first()->path) }}"
            alt="{{ $post->images->first()->alt_text ?: $post->title }}"
            class="size-full object-cover transition duration-500 group-hover:scale-105"
            loading="lazy">

    </a>

    @else

    <a
        href="{{ route('posts.show', $post) }}"
        class="flex aspect-[16/10] shrink-0 items-center justify-center bg-primary-50"
        aria-hidden="true">

        <span class="text-3xl font-semibold text-primary-200">
            V
        </span>

    </a>

    @endif


    {{-- Contenu --}}
    <div class="flex flex-1 flex-col p-6">

        {{-- Date --}}
        <time
            datetime="{{ $post->published_at->toIso8601String() }}"
            class="shrink-0 text-xs font-semibold uppercase tracking-wider text-accent-600">
            {{ $post->published_at->translatedFormat('d F Y') }}
        </time>


        {{-- Titre --}}
        <h3
            class="mt-3 h-7 shrink-0 overflow-hidden text-xl font-semibold leading-7 tracking-tight text-primary-950">

            <a
                href="{{ route('posts.show', $post) }}"
                class="block truncate transition hover:text-primary-600"
                title="{{ $post->title }}">
                {{ $post->title }}
            </a>

        </h3>


        {{-- Description --}}
        <p
            class="mt-3 h-[4.5rem] shrink-0 overflow-hidden text-sm leading-6 text-stone-600 line-clamp-3">
            {{ $post->description }}
        </p>


        {{-- Lien --}}
        <a
            href="{{ route('posts.show', $post) }}"
            class="mt-auto inline-flex shrink-0 items-center pt-5 text-sm font-semibold text-primary-800 transition hover:text-primary-600">

            Lire l'actualité

            <span
                class="ml-1 transition-transform duration-200 group-hover:translate-x-1"
                aria-hidden="true">
                →
            </span>

        </a>

    </div>

</article>