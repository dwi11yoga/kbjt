@props(['model' => null, 'id' => null, 'label' => null, 'footnote' => null, 'toggleLocation' => 'right'])

<div>
    <label class="flex items-center gap-2 justify-between cursor-pointer">
        <input type="checkbox" wire:model.live='{{ $model }}' class="sr-only peer" name="{{ $id }}">
        <div class="{{ $toggleLocation == 'left' ? 'order-2' : '' }}">
            <div class="">{{ $label }}</div>
            <div class="text-sm">{{ $footnote }}</div>
        </div>
        <div
            class="{{ $toggleLocation != 1 ? 'order-1' : '' }} relative w-11 h-6 mr-1 bg-gray-200 dark:bg-zinc-800 rounded-full peer peer-focus:ring-4 peer-focus:ring-amber-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-400">
        </div>
    </label>
    @error($model)
        <div class="text-xs text-red-600 mb-2">{{ $message }}</div>
    @enderror
</div>
