@props(['type' => 'button', 'action' => null, 'name' => null, 'icon' => null, 'textColor' => null])


@if ($type == 'button')
    <button type="button" wire:click='{{ $action }}'
        class="w-full flex justify-between py-2 px-3 rounded-lg dark:hover:bg-zinc-700 hover:bg-neutral-100 cursor-pointer {{ $textColor }}">
        <div>{{ $name }}</div>
        <i data-lucide='{{ $icon }}' class="size-5"></i>
    </button>
@else
    <a href="{{ $action }}"
        class="w-full flex justify-between py-2 px-3 rounded-lg dark:hover:bg-zinc-700 hover:bg-neutral-100 cursor-pointer {{ $textColor }}">
        <div>{{ $name }}</div>
        <i data-lucide='{{ $icon }}' class="size-5"></i>
    </a>
@endif
