@props(['title', 'color' => null])

@php
    switch ($color) {
        case 'red':
            $accent = 'bg-red-200';
            break;
        case 'green':
            $accent = 'bg-green-300';
            break;
        default:
            $accent = 'bg-neutral-100';
            break;
    }
@endphp

<div class="">
    {{-- hitamkan background --}}
    <div class="fixed -top-0 left-0 w-full h-full z-50 backdrop-blur-sm"></div>
    <div class="fixed -top-0 left-0 bg-black opacity-10 w-full h-full z-50 backdrop-blur-2xl"></div>
    {{-- popup --}}
    <div
        class="max-w-96 fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 bg-white rounded-lg overflow-hidden">
        {{-- title window --}}
        <div class="flex items-center justify-between {{ $accent }} px-4 py-3">
            <div class="font-bold">{{ $title }}</div>
        </div>
        <div class="px-4 py-2 pb-4 space-y-2">
            {{ $slot }}
        </div>
    </div>
</div>
