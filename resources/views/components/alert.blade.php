@props(['color' => 'green', 'message' => null, 'textSize' => 'text-base', 'icon' => null])

@php
    switch ($color) {
        case 'blue':
            $color = 'bg-blue-100 dark:bg-blue-900';
            break;
        case 'red':
            $color = 'bg-red-100 dark:bg-red-900';
            break;
        default:
            $color = 'bg-green-100 dark:bg-green-900';
            break;
    }
@endphp

<div class="flex items-center gap-1 {{ $color }} rounded-xl p-3 shadow-sm mb-4 {{ $textSize }}">
    @if ($icon)
        <div class="">
            <i data-lucide='{{ $icon }}' class="size-4"></i>
        </div>
    @endif
    <div>{{ $message }}</div>
</div>
