@extends('layouts.app')

@section('title', 'Actualités | Mairie de Veckersviller')

@section('description', 'Retrouvez les dernières actualités et informations de la commune de Veckersviller en Moselle.')

@section('content')

{{-- En-tête --}}
<section class="border-b border-stone-200 bg-white">

    <x-site.container class="py-16 sm:py-20">

        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-600">
            Commune
        </p>

        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-primary-950 sm:text-5xl">
            Actualités
        </h1>

        <p class="mt-5 max-w-2xl text-lg leading-8 text-stone-600">
            Retrouvez les dernières informations et actualités
            de la commune de Veckersviller.
        </p>

    </x-site.container>

</section>


{{-- Liste --}}
<section class="bg-stone-50">

    <x-site.container class="py-12 sm:py-16">

        @if ($posts->isEmpty())

        <div class="rounded-2xl border border-dashed border-stone-300 bg-white p-12 text-center">

            <p class="text-sm text-stone-600">
                Aucune actualité pour le moment.
            </p>

        </div>

        @else

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

            @foreach ($posts as $post)
            <x-site.post-card :post="$post" />
            @endforeach

        </div>

        {{-- Pagination --}}
        @if ($posts->hasPages())
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
        @endif

        @endif

    </x-site.container>

</section>

@endsection