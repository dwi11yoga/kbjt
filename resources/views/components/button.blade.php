@props([
    'type' => 'button',
    'url' => null,
    'disabled' => false,
    'text',
    'icon' => null,
    'model' => null,
    'target' => null,
    'textLoading' => 'Loading...',
    'color' => 'bg-amber-400',
    'rounded' => 'full',
    'width' => null,
])

<button type="{{ $type }}"
    @isset($url)
        onclick="window.location='{{ $url }}'"
    @endisset
    {{ $disabled ? 'disabled' : '' }} wire:click='{{ $model }}'
    class="rounded-{{ $rounded }} py-3 px-4 {{ $color }} text-neutral-800 hover:bg-opacity-90 flex items-center justify-center gap-1 {{ $width }} active:scale-95 transition-transform duration-200">
    @if ($target)
        {{-- icon --}}
        <div wire:target='{{ $target }}' wire:loading class="animate-spin">
            <i data-lucide='loader' class="size-5"></i>
        </div>
        {{-- tilisan --}}
        <div wire:target='{{ $target }}' wire:loading class="">{{ $textLoading }}</div>
    @endif
    @if ($icon)
        <i wire:target='{{ $target }}' {{ $target ? 'wire:loading.remove' : '' }}
            data-lucide='{{ $icon }}' class="md:size-5 size-4"></i>
    @endif
    <div wire:target='{{ $target }}' {{ $target ? 'wire:loading.remove' : '' }}
        class="text-nowrap md:text-base text-sm">
        {{ $text }}</div>
</button>
