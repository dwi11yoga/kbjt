@props(['type' => 'url', 'url' => '#'])

@if ($type == 'url')
    <a href="{{ $url }}"
        class="border border-neutral-200 p-3 mt-3 rounded-xl flex md:flex-row flex-col md:justify-between md:gap-1 hover:outline outline-amber-400">
        {{-- default slot --}}
        {{ $slot }}
        {{-- left text slot --}}
        @isset($leftText)
            <div class="flex flex-wrap items-center gap-1">
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
    <div
        class="border border-neutral-200 pr-3 mt-3 rounded-xl flex md:flex-row flex-col md:justify-between md:gap-1 hover:outline outline-amber-400">
        {{-- default slot --}}
        {{ $slot }}
        {{-- left text slot --}}
        @isset($leftText)
            <div class="flex flex-wrap items-center gap-1 w-full py-3 pl-3">
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
