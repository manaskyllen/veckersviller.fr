@props([
'title',
'description' => null,
'link' => null,
'linkText' => null,
])

<div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

    <div>
        <h2 class="text-2xl font-semibold tracking-tight text-primary-950 sm:text-3xl">
            {{ $title }}
        </h2>

        @if ($description)
        <p class="mt-2 max-w-2xl text-sm leading-6 text-stone-600 sm:text-base">
            {{ $description }}
        </p>
        @endif
    </div>

    @if ($link && $linkText)
    <a
        href="{{ $link }}"
        class="shrink-0 text-sm font-semibold text-primary-800 transition hover:text-primary-600">
        {{ $linkText }}
        <span aria-hidden="true">→</span>
    </a>
    @endif

</div>