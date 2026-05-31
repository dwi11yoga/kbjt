@props([
    'title' => null,
    'url' => null,
    'urlText' => null,
    'value' => null,
    'footnote' => null,
    'marginBottom' => 'mb-0',
    'padding' => 'px-4 py-5',
])

<div
    class="border bg-white border-neutral-200 rounded-xl {{ $padding }}  hover:outline outline-amber-400 decoration-1">
    <div class="flex items-center justify-between {{ $marginBottom }}">
        <div class="">{{ $title }}</div>
        @if (!empty($urlText))
            <a href="{{ $url }}"
                class="text-sm flex items-center hover:underline decoration-4 underline-offset-4 decoration-amber-400">
                <div class="">{{ $urlText }} </div>
                <i data-lucide='arrow-right' class="w-4"></i>
            </a>
        @endif
    </div>
    <h1 class="font-bold">
        {{ $value }}
    </h1>
    {{ $slot }}
    <div class="text-sm">
        {{ $footnote }}
    </div>
</div>
