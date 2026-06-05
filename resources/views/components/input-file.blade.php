@props([
    'id',
    'model' => null,
    'label' => null,
    'fileTypes' => null,
    'icon' => 'image-up',
    'maxSize' => null,
    'ratio' => null,
    'fileName' => null,
    'filePreviewUrl' => null,
])

<div class="space-y-1">
    <div class="">{{ $label }}</div>
    <input wire:model.live.blur='{{ $model }}' name="{{ $id }}" id="{{ $id }}" type="file"
        class="sr-only peer">
    <label for="{{ $id }}"
        class="relative group w-full {{ empty($filePreviewUrl) ? 'py-12' : 'p-2' }} overflow-hidden bg-neutral-100 flex flex-col justify-center items-center gap-2 rounded-xl cursor-pointer {{ $errors->has($model) ? 'ring-2 ring-red-600' : 'hover:ring-2' }} peer-focus-within:ring-2 ring-amber-400">
        @if (!empty($filePreviewUrl))
            <img src="{!! $filePreviewUrl !!}" class="rounded-lg max-h-96">
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 hidden group-hover:flex items-center gap-2 bg-amber-400 rounded-full py-2 px-3">
                <i data-lucide='{{ $icon }}' class="size-5"></i>
                <div class="">Pilih gambar</div>
            </div>
            <button wire:click='$set("{{ $model }}", null)' type="button"
                class="absolute top-3 right-3 p-2 rounded-full bg-neutral-200 hover:bg-amber-200 z-10 active:scale-90 transition-transform ease-in-out"
                title="Reset foto">
                <i data-lucide='x' class="size-5"></i>
            </button>
        @else
            <i data-lucide='{{ $icon }}' class="size-5"></i>
            <div class="">Pilih gambar</div>
            <div class="text-xs text-neutral-600">
                {{ $fileTypes }} {{ !empty($maxSize) ? 'hingga ' . $maxSize : '' }} {{ !empty($ratio) ? 'dengan rasio ' . $ratio : '' }}
            </div>
        @endif
    </label>
    <div class="flex justify-between">
        <div class="text-xs">
            {{ $fileName }}
        </div>
        @error($model)
            <div class="text-xs text-red-600">{{ $message }}</div>
        @enderror
    </div>
</div>
