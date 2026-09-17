@props(['alert'])

<aside
    class="sticky top-0 border-y border-amber-200 bg-amber-50"
    aria-label="Information importante">
    <div class="mx-auto flex max-w-7xl gap-4 px-4 py-4 sm:px-6 lg:px-8">

        <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-700">
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
                    d="M12 9v4m0 4h.01M10.3 3.84 2.7 17a2 2 0 0 0 1.73 3h15.14a2 2 0 0 0 1.73-3L13.7 3.84a2 2 0 0 0-3.4 0Z" />
            </svg>
        </div>

        <div class="min-w-0">
            <p class="text-sm font-semibold text-amber-950">
                {{ $alert->title }}
            </p>

            <div class="mt-1 text-sm leading-6 text-amber-900">
                {!! nl2br(e($alert->content)) !!}
            </div>
        </div>

    </div>
</aside>