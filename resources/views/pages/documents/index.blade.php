@extends('layouts.app')

@section('title', 'Documents municipaux | Mairie de Veckersviller')

@section('description', 'Consultez les documents municipaux de la commune de Veckersviller.')

@section('content')

{{-- En-tête --}}
<section class="border-b border-stone-200 bg-white">

    <x-site.container class="py-16 sm:py-20">

        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-600">
            Vie municipale
        </p>

        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-primary-950 sm:text-5xl">
            Documents municipaux
        </h1>

        <p class="mt-5 max-w-2xl text-lg leading-8 text-stone-600">
            Consultez les documents publiés par la commune de Veckersviller.
        </p>

    </x-site.container>

</section>


{{-- Documents --}}
<section class="bg-stone-50">

    <x-site.container class="py-12 sm:py-16">

        {{-- Filtres --}}
        <form
            method="GET"
            action="{{ route('documents.index') }}"
            class="rounded-2xl border border-stone-200 bg-white p-5 sm:p-6">

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-[1fr_1fr_auto] lg:items-end">

                {{-- Type --}}
                <div>
                    <label
                        for="type"
                        class="block text-sm font-medium text-primary-950">
                        Type de document
                    </label>

                    <select
                        id="type"
                        name="type"
                        class="mt-2 block w-full rounded-lg border-stone-300 bg-white px-3 py-2.5 text-sm text-stone-900 shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        <option value="">
                            Tous les documents
                        </option>

                        @foreach ($types as $type)

                        <option
                            value="{{ $type->id }}"
                            @selected(request('type')===$type->id)
                            >
                            {{ $type->name }}
                        </option>

                        @endforeach

                    </select>
                </div>


                {{-- Année --}}
                <div>
                    <label
                        for="year"
                        class="block text-sm font-medium text-primary-950">
                        Année
                    </label>

                    <select
                        id="year"
                        name="year"
                        class="mt-2 block w-full rounded-lg border-stone-300 bg-white px-3 py-2.5 text-sm text-stone-900 shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        <option value="">
                            Toutes les années
                        </option>

                        @foreach ($years as $year)

                        <option
                            value="{{ $year }}"
                            @selected((string) request('year')===(string) $year)>
                            {{ $year }}
                        </option>

                        @endforeach

                    </select>
                </div>


                {{-- Actions --}}
                <div class="flex gap-3">

                    <button
                        type="submit"
                        class="flex-1 rounded-lg bg-primary-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-800 lg:flex-none">
                        Filtrer
                    </button>

                    @if (request()->hasAny(['type', 'year']))
                    <a
                        href="{{ route('documents.index') }}"
                        class="rounded-lg border border-stone-200 px-5 py-2.5 text-sm font-semibold text-stone-700 transition hover:bg-stone-50">
                        Réinitialiser
                    </a>
                    @endif

                </div>

            </div>

        </form>


        {{-- Résultats --}}
        <div class="mt-8">

            @if ($documents->isEmpty())

            <div class="rounded-2xl border border-dashed border-stone-300 bg-white p-12 text-center">

                <p class="font-medium text-primary-950">
                    Aucun document trouvé
                </p>

                <p class="mt-2 text-sm text-stone-500">
                    Essayez de modifier vos critères de recherche.
                </p>

            </div>

            @else

            <div class="space-y-3">

                @foreach ($documents as $document)
                <x-site.document-card :document="$document" />
                @endforeach

            </div>


            {{-- Pagination --}}
            @if ($documents->hasPages())
            <div class="mt-10">
                {{ $documents->links() }}
            </div>
            @endif

            @endif

        </div>

    </x-site.container>

</section>

@endsection