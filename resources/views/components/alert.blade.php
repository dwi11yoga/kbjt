@props(['color' => 'green', 'message' => null, 'textSize' => 'text-base', 'icon' => null])

<div class="flex items-center gap-1 bg-{{ $color }}-100 rounded-xl p-3 shadow-sm mb-4 {{ $textSize }}">
    @if ($icon)
        <div class="">
            <i data-lucide='{{ $icon }}' class="size-4"></i>
        </div>
    @endif
    <div>{{ $message }}</div>
</div>
