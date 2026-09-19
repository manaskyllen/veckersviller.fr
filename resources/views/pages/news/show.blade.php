@extends('layouts.app')

@section('title', $post->title . ' | Mairie de Veckersviller')

@section('description')
{{ \Illuminate\Support\Str::limit(strip_tags($post->description), 155) }}
@endsection

@section('content')

<article>

    {{-- En-tête de l'article --}}
    <header class="bg-white">

        <x-site.container class="pb-10 pt-12 sm:pb-12 sm:pt-16 lg:pt-20">

            <a
                href="{{ route('posts.index') }}"
                class="animate-hero inline-flex items-center text-sm font-medium text-stone-500 transition hover:text-primary-800">
                <span class="mr-2" aria-hidden="true">←</span>
                Toutes les actualités
            </a>

            <div class="mt-8 max-w-4xl">

                <time
                    datetime="{{ $post->published_at->toIso8601String() }}"
                    class="animate-hero-delay-1 text-sm font-semibold uppercase tracking-wider text-accent-600">
                    {{ $post->published_at->translatedFormat('d F Y') }}
                </time>

                <h1 class="animate-hero-delay-2 mt-3 text-4xl font-semibold tracking-tight text-primary-950 sm:text-5xl">
                    {{ $post->title }}
                </h1>

            </div>

        </x-site.container>

    </header>


    {{-- Galerie --}}
    @if ($post->images->isNotEmpty())

    <section class="bg-white">

        <x-site.container>

            <div
                data-reveal="scale"
                class="overflow-hidden rounded-2xl">

                <img
                    src="{{ Storage::disk('public')->url($post->images->first()->path) }}"
                    alt="{{ $post->images->first()->alt_text ?: $post->title }}"
                    class="max-h-[650px] w-full object-cover transition duration-700 hover:scale-[1.01]">

            </div>

            @if ($post->images->count() > 1)

            <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                @foreach ($post->images->skip(1) as $index => $image)

                <div
                    data-reveal
                    style="--reveal-delay: {{ min($index * 100, 300) }}ms"
                    class="aspect-[4/3] overflow-hidden rounded-xl bg-stone-100">

                    <img
                        src="{{ Storage::disk('public')->url($image->path) }}"
                        alt="{{ $image->alt_text ?: $post->title }}"
                        class="size-full object-cover transition duration-500 hover:scale-105"
                        loading="lazy">

                </div>

                @endforeach

            </div>

            @endif

        </x-site.container>

    </section>

    @endif


    {{-- Contenu --}}
    <section class="bg-stone-50">

        <x-site.container class="py-12 sm:py-16">

            <div
                data-reveal
                class="mx-auto max-w-3xl">

                <div class="prose prose-stone max-w-none">
                    {!! $post->description !!}
                </div>

            </div>

        </x-site.container>

    </section>

</article>

@endsection