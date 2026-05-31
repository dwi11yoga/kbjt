@props([
    'type' => 'button',
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

<button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} wire:click='{{ $model }}'
    class="rounded-{{ $rounded }} py-3 px-4 {{ $color }} hover:bg-opacity-90 flex items-center justify-center gap-1 {{ $width }}">
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
            data-lucide='{{ $icon }}' class="size-5"></i>
    @endif
    <div wire:target='{{ $target }}' {{ $target ? 'wire:loading.remove' : '' }} class="">
        {{ $text }}</div>
</button>
