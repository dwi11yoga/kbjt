@props([
    'number' => null,
    'username' => null,
    'name' => null,
    'avatar',
    'level' => null,
    'point' => null,
    'style' => null,
])

{{-- opsi warna --}}
@php
    if ($style == 'gold') {
        $style = 'bg-yellow-100 dark:bg-yellow-500 text-neutral-800 outline-yellow-300 hover:bg-yellow-200 active:bg-yellow-200';
    } elseif ($style == 'silver') {
        $style = 'bg-gray-100 dark:bg-gray-300 text-neutral-800 outline-gray-300 hover:bg-gray-200 active:bg-gray-200';
    } elseif ($style == 'bronze') {
        $style = 'bg-amber-100 dark:bg-amber-600 text-neutral-800 outline-amber-300 hover:bg-amber-200 active:bg-amber-200';
    } else {
        $style = 'bg-neutral-50 dark:bg-zinc-800 outline-amber-400 hover:bg-neutral-100 active:bg-neutral-200';
    }
@endphp

<a href="/u/{{ str_replace('&commat;', '', $username) }}" id="user{{ $number }}"
    class="flex items-center justify-between py-2 px-4 rounded-2xl ease-in-out transition-all hover:outline outline-2 {{ $style }}">
    {{-- sbeelah kiri --}}
    <div class="flex gap-3 items-center">
        @if ($number)
            <div class="{{ $number <= 3 ? 'font-bold' : '' }}">#{{ $number }}</div>
        @endif
        <x-avatar avatarUrl="{{ $avatar }}" />
        <div class="flex gap-2 items-center">
            @if ($name)
                <div class="text-base font-bold">{{ $name }}</div>
            @endif
            @if ($username)
                <div>{!! $username !!}</div>
            @endif
            @if ($level)
            <x-badge color="bg-amber-400 text-neutral-800">
                Lv.{{ $level }}
            </x-badge>
            @endif
        </div>
    </div>
    {{-- kanan --}}
    @if ($point)
        <div class="flex gap-2 items-center text-sm" title="Poin pengguna">
            <i data-lucide='astroid' class="size-4 fill-black dark:fill-white stroke-none"></i>
            {{ $point }}
        </div>
    @endif
</a>
