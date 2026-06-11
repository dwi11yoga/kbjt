@props([
    'id',
    'model' => null,
    'type' => 'text',
    'label' => null,
    'placeholder' => null,
    'value' => null,
    'autofocus' => false,
    'footnote' => null,
    'disabled' => false,
    'customStyle' => null,
    'maxLength' => null,
])

<div class="space-y-1">
    @if ($label)
        <label for="{{ $id }}">{{ $label }}</label>
    @endif
    <input wire:model.live.blur='{{ $model }}' name="{{ $id }}" id="{{ $id }}"
        type="{{ $type }}" placeholder="{{ $placeholder }}" value="{{ $value }}"
        maxlength="{{ $maxLength }}" {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled' : '' }}
        class="px-4 py-3 w-full rounded-md block bg-neutral-100 dark:bg-zinc-800 focus:border-b-2 focus:rounded-b-none outline-none transition-all ease-in-out duration-75 {{ $customStyle }}
        {{ $errors->has($model) ? 'border-red-600' : 'border-amber-400' }}">
    @if ($footnote)
        <div class="text-xs">{{ $footnote }}</div>
    @endif
    @error($model)
        <div class="text-xs text-red-600 -mt-2">{{ $message }}</div>
    @enderror
</div>
