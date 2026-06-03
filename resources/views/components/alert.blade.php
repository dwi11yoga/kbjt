@props(['color' => 'green', 'message' => null, 'textSize' => 'text-base', 'icon' => null])

<div
    class="flex flex-wrap items-center gap-1 bg-{{ $color }}-100 rounded-xl p-3 shadow-sm mb-4 {{ $textSize }}">
    @if ($icon)
        <i data-lucide='{{ $icon }}' class="size-4"></i>
    @endif
    <div>{{ $message }}</div>
</div>
