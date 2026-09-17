@props(['post'])

<article class="group overflow-hidden rounded-2xl border border-stone-200 bg-white transition duration-300 hover:-translate-y-1 hover:shadow-lg">

    @if ($post->images->isNotEmpty())
    <a
        href="{{ route('posts.show', $post) }}"
        class="block aspect-[16/10] overflow-hidden bg-stone-100">
        <img
            src="{{ Storage::disk('public')->url($post->images->first()->path) }}"
            alt="{{ $post->images->first()->alt_text ?: $post->title }}"
            class="size-full object-cover transition duration-500 group-hover:scale-105"
            loading="lazy">
    </a>
    @else
    <a
        href="{{ route('posts.show', $post) }}"
        class="flex aspect-[16/10] items-center justify-center bg-primary-50"
        aria-hidden="true">
        <span class="text-3xl font-semibold text-primary-200">
            V
        </span>
    </a>
    @endif

    <div class="p-6">

        <time
            datetime="{{ $post->published_at->toIso8601String() }}"
            class="text-xs font-semibold uppercase tracking-wider text-accent-600">
            {{ $post->published_at->translatedFormat('d F Y') }}
        </time>

        <h3 class="mt-3 text-xl font-semibold tracking-tight text-primary-950">
            <a
                href="{{ route('posts.show', $post) }}"
                class="transition hover:text-primary-600">
                {{ $post->title }}
            </a>
        </h3>

        <p class="mt-3 line-clamp-3 text-sm leading-6 text-stone-600">
            {{ $post->description }}
        </p>

        <a
            href="{{ route('posts.show', $post) }}"
            class="mt-5 inline-flex items-center text-sm font-semibold text-primary-800 transition hover:text-primary-600">
            Lire l'actualité

            <span
                class="ml-1 transition-transform duration-200 group-hover:translate-x-1"
                aria-hidden="true">
                →
            </span>
        </a>

    </div>
</article>