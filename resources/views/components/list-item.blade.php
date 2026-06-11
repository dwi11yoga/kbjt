@props(['type' => 'url', 'url' => '#', 'onclick' => null])

@if ($type == 'url')
    <a href="{{ $url }}"
        class="border dark:border-zinc-800 border-neutral-200 p-3 rounded-xl flex md:flex-row flex-col md:justify-between gap-1 hover:outline outline-amber-400">
        {{-- default slot --}}
        {{ $slot }}
        {{-- left text slot --}}
        @isset($leftText)
            <div class="flex flex-wrap items-center gap-1 w-full">
                {{ $leftText }}
            </div>
        @endisset
        {{-- right side slot --}}
        @isset($rightText)
            <div class="md:text-base text-sm flex items-center">
                {{ $rightText }}
            </div>
        @endisset
    </a>
@endif
@if ($type == 'div')
    <div wire:click='{{ $onclick }}'
        class="border dark:border-zinc-800 border-neutral-200 md:pr-3 md:py-0 md:pl-0 p-3 rounded-xl flex md:flex-row flex-col md:justify-between gap-1 hover:outline outline-amber-400">
        {{-- default slot --}}
        {{ $slot }}
        {{-- left text slot --}}
        @isset($leftText)
            <div class="flex flex-wrap items-center gap-1 w-full md:py-3 md:pl-3">
                {{ $leftText }}
            </div>
        @endisset
        {{-- right side slot --}}
        @isset($rightText)
            <div class="md:text-base text-sm flex items-center">
                {{ $rightText }}
            </div>
        @endisset
    </div>
@endif
