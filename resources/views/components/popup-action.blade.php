@props([
    'target' => null,
    'text' => 'Simpan',
    'textLoading' => 'Menyimpan...',
    'closeAction' => null,
    'closeText' => 'Batal',
    'bgColor' => 'bg-green-600',
    'withPositiveButton' => true,
])

<div class="space-y-1">
    @if ($withPositiveButton)
        <x-button type="submit" width="w-full" target="{{ $target }}" color="{{ $bgColor }}"
            text="{{ $text }}" textLoading="{{ $textLoading }}" />
    @endif
    <div wire:click='{{ $closeAction }}'>
        <x-button type="button" width="w-full" color="hover:outline outline-2 dark:outline-zinc-700 dark:text-zinc-200"
            text="{{ $closeText }}" />
    </div>
</div>
