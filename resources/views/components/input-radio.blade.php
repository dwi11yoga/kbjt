@props(['id', 'model', 'text', 'value', 'icon' => null, 'style' => 1, 'customStyle'=>null])

@if ($style == 1)
    <label for="{{ $id }}"
        class="flex items-center  gap-1 w-fit h-fit text-sm px-4 py-2 rounded-full bg-amber-100 dark:bg-zinc-800 has-[:checked]:bg-amber-400 has-[:checked]:dark:bg-amber-400 has-[:checked]:dark:text-neutral-800 hover:bg-amber-200 dark:hover:bg-zinc-700 border-2 border-amber-400 dark:border-zinc-700 transition-all ease-in-out duration-75 cursor-pointer">
        <input type="radio" wire:model.live='{{ $model }}' name="{{ $model }}" id="{{ $id }}"
            value="{{ $value }}" class="peer sr-only">
        <div class="{{ empty($icon) ? 'peer-checked:block hidden' : '' }}" wire:ignore><i
                data-lucide='{{ $icon ?? 'check' }}' class="size-4"></i></div>
        <div class="text-nowrap peer-focus-within:pl-1 ease-in-out transition-all">{{ $text }}</div>
    </label>
@elseif($style == 2)
    <label for="{{ $id }}"
        class="flex items-center  gap-1 w-full h-fit px-5 py-4 rounded-md bg-neutral-100 dark:bg-zinc-800 dark:has-[:checked]:bg-amber-400 dark:has-[:checked]:text-neutral-800 has-[:checked]:bg-amber-400 dark:hover:bg-zinc-700 hover:bg-amber-200 transition-all ease-in-out duration-75 cursor-pointer">
        <input type="radio" wire:model.live='{{ $model }}' name="{{ $model }}"
            id="{{ $id }}" value="{{ $value }}" class="peer sr-only">
        <div class="{{ empty($icon) ? 'peer-checked:block hidden' : '' }}" wire:ignore><i
                data-lucide='{{ $icon ?? 'check' }}' class="size-5"></i></div>
        <div class="{{ empty($icon) ? 'peer-checked:hidden' : '' }}" wire:ignore><i data-lucide='squircle'
                class="size-5"></i></div>
        <div class="text-nowrap peer-focus-within:pl-2 ease-in-out transition-all">{{ $text }}</div>
    </label>
@else
    <label for="{{ $id }}"
        class="{{ $customStyle }} flex items-center gap-1 w-fit h-fit text-sm px-2 py-1 rounded-full bg-neutral-100 dark:bg-zinc-800 has-[:checked]:bg-amber-400 has-[:checked]:dark:bg-amber-400 has-[:checked]:dark:text-neutral-800 hover:bg-amber-200 dark:hover:bg-zinc-700 transition-all ease-in-out duration-75 cursor-pointer">
        <input type="radio" wire:model.live='{{ $model }}' name="{{ $model }}"
            id="{{ $id }}" value="{{ $value }}" class="peer sr-only">
        <div class="{{ empty($icon) ? 'peer-checked:block hidden' : '' }}" wire:ignore><i
                data-lucide='{{ $icon ?? 'check' }}' class="size-4"></i></div>
        <div class="text-nowrap peer-focus-within:pl-1 ease-in-out transition-all">{{ $text }}</div>
    </label>
@endif
