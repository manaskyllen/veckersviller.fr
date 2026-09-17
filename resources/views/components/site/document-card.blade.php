@props(['document'])

<div class="group flex items-center justify-between gap-5 rounded-xl border border-stone-200 bg-white p-5 transition duration-200 hover:border-primary-200 hover:shadow-sm">

    <div class="flex min-w-0 items-center gap-4">

        <div class="flex size-11 shrink-0 items-center justify-center rounded-lg bg-primary-50 text-primary-800">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                class="size-5"
                aria-hidden="true">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6Z" />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14 2v6h6M8 13h8M8 17h5" />
            </svg>
        </div>

        <div class="min-w-0">

            <div class="flex flex-wrap items-center gap-2">
                <span class="rounded-full bg-primary-50 px-2.5 py-1 text-xs font-medium text-primary-800">
                    {{ $document->type->name }}
                </span>

                @if ($document->document_date)
                <time
                    datetime="{{ $document->document_date->toDateString() }}"
                    class="text-xs text-stone-500">
                    {{ $document->document_date->format('d/m/Y') }}
                </time>
                @endif
            </div>

            <h3 class="mt-2 truncate font-semibold text-primary-950">
                {{ $document->title }}
            </h3>

        </div>

    </div>

    <a
        href="{{ Storage::disk('public')->url($document->file_path) }}"
        target="_blank"
        rel="noopener noreferrer"
        class="flex shrink-0 items-center gap-2 rounded-lg border border-stone-200 px-3 py-2 text-sm font-semibold text-primary-800 transition hover:bg-stone-50"
        aria-label="Ouvrir {{ $document->title }} au format PDF">
        <span class="hidden sm:inline">PDF</span>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            class="size-4"
            aria-hidden="true">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M7 17 17 7M7 7h10v10" />
        </svg>
    </a>

</div>