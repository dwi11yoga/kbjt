@props(['id', 'model' => null, 'label' => null, 'options' => [], 'autofocus' => false])

<div class="space-y-1 mt-2">
    @if ($label)
        <label for="{{ $id }}">{{ $label }}</label>
    @endif
    <div class="relative">
        <div class="absolute top-4 right-2 bg-neutral-100">
            <i data-lucide='chevron-down' class="size-5"></i>
        </div>
        <select wire:model.live.blur='{{ $model }}' name="{{ $id }}" id="{{ $id }}"
            {{ $autofocus ? 'autofocus' : '' }}
            class="px-4 py-3 w-full appearance-none rounded-md block bg-neutral-100 focus:border-b-2 focus:rounded-b-none outline-none transition-all ease-in-out duration-75 
        {{ $errors->has($model) ? 'border-red-500' : 'border-amber-400' }}">
            @foreach ($options as $key => $option)
                <option value="{{ $key }}">{{ $option }}</option>
            @endforeach
        </select>
    </div>
    @error($model)
        <div class="text-xs text-red-600 -mt-2">{{ $message }}</div>
    @enderror
</div>
