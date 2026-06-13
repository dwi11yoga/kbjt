@props(['name' => null, 'namePosition' => 'top', 'rounded' => null, 'model' => null, 'customStyle' => null])

<div class="space-y-1 {{ $namePosition == 'left' ? 'flex items-center' : '' }} {{ !empty($name) ? 'gap-2' : '' }} {{ $customStyle }}">
    <legend>{{ $name }}</legend>
    @error($model)
        <div class="text-xs text-red-600 -mt-2">{{ $message }}</div>
    @enderror
    <fieldset class="flex flex-wrap items-center gap-1 w-full {{ $rounded }}">
        {{ $slot }}
    </fieldset>

</div>
