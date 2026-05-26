@props([
    'id',
    'model' => null,
    'type' => 'text',
    'label' => null,
    'placeholder' => null,
    'value' => null,
    'autofocus' => false,
])

<div class="space-y-1 mt-2">
    @if ($label)
        <label for="{{ $id }}">{{ $label }}</label>
    @endif
    <input wire:model.live.blur='{{ $model }}' name="{{ $id }}" id="{{ $id }}" type="{{ $type }}"
        placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $autofocus ? 'autofocus' : '' }}
        class="px-4 py-3 w-full rounded-md block bg-neutral-100 focus:border-b-2 focus:rounded-b-none outline-none transition-all ease-in-out duration-75 
        {{ $errors->has($model) ? 'border-red-500' : 'border-amber-400' }}">
    @error($model)
        <div class="text-xs text-red-600 -mt-2">{{ $message }}</div>
    @enderror
</div>
