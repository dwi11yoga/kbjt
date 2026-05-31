@props([
    'color' => 'bg-neutral-100',
    'hoverColor' => 'bg-amber-400',
    'title' => null,
    'gap' => 0,
    'padding' => 'py-1 px-2',
])

<div class="flex items-center rounded-full {{ $padding }} {{ $color }} hover:{{ $hoverColor }} text-sm gap-{{ $gap }}"
    title="{{ $title }}">
    {{ $slot }}
</div>
