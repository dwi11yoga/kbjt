{{-- item yag ditampilkan pada halaman report --}}

@props(['width' => 'full', 'id', 'model', 'value', 'icon' => null, 'text' => null])

<div class="w-{{ $width }}">
    <input type="radio" wire:model.live='{{ $model }}' name="{{ $model }}" id="{{ $id }}"
        value="{{ $value }}" class="hidden peer" {{ old('pelanggaran') == 'true' ? 'checked' : '' }}>
    <label for="{{ $id }}"
        class="w-full flex items-center rounded-xl bg-neutral-100 border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400 active:scale-95 transition-transform duration-200">
        @isset($icon)
            <div wire:ignore>
                <i data-lucide='{{ $icon }}' class="size-5"></i>
            </div>
        @endisset
        <span>{{ $text }}</span>
    </label>
</div>
