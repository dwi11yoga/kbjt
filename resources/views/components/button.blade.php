@props([
    'type' => 'button',
    'disabled' => false,
    'text',
    'icon' => 'save',
    'target' => '',
    'textLoading' => 'Loading...',
])

<button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }}
    class="rounded-full bg-amber-400 py-3 px-4 hover:bg-white border-2 border-amber-400 flex items-center gap-1">
    {{-- icon --}}
    <div wire:target='{{ $target }}' wire:loading class="animate-spin">
        <i data-lucide='loader' class="size-5"></i>
    </div>
    <i wire:target='{{ $target }}' wire:loading.remove data-lucide='{{ $icon }}' class="size-5"></i>
    {{-- tilisan --}}
    <div wire:target='{{ $target }}' wire:loading class="">{{ $textLoading }}</div>
    <div wire:target='{{ $target }}' wire:loading.remove class="">{{ $text }}</div>
</button>
