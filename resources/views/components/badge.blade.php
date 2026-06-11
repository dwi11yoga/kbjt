@props([
    'color' => 'bg-neutral-100 text-neutral-800 dark:bg-zinc-800 dark:text-zinc-200',
    'hoverColor' => 'hover:bg-amber-400 dark:hover:bg-amber-400 dark:hover:text-neutral-800',
    'title' => null,
    'gap' => 0,
    'padding' => 'py-1 px-2',
])

<div class="flex text-nowrap items-center rounded-full {{ $padding }} {{ $color }} {{ $hoverColor }} text-sm gap-{{ $gap }}"
    title="{{ $title }}">
    {{ $slot }}
</div>
