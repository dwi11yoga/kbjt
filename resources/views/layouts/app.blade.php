<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- judul --}}
    <title>{{ isset($title) ? $title . ' - ' : '' }} {{ env('APP_NAME') }}</title>

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- font --}}
    {{-- NOTO SANS & NOTO SANS JAVANESE --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Javanese:wght@400..700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- import trix editor 2.0.8 --}}
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- load darkmode sebelum halaman dimuat --}}
    <script>
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    {{-- Import custom --}}
    {{-- @yield('head') --}}

    {{-- Feathericon --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> --}}
</head>

<body class="">
    <livewire:navbar />

    {{-- header untuk hal. detail user --}}
    @if (isset($header))
        <div class="">{{ $header }}</div>
    @endif

    {{-- Konten --}}
    @php
        // cek apakah user berada di home/tidak
        $path = request()->path();
        $location = explode('/', $path)[0];
    @endphp
    <main class="container mx-auto px-5 md:px-0 pt-10 pb-2 min-h-[90vh]">
        <div class="grid grid-cols-4 gap-6">
            <div
                class="{{ !in_array($location, ['', 'masuk']) ? 'md:col-span-3' : 'md:col-span-4' }} col-span-4 space-y-5">
                {{ $slot ?? '' }}
                @yield('slot')
            </div>
            {{-- Banner --}}
            @if (!in_array($location, ['', 'masuk']))
                <div class="md:col-span-1 col-span-4">
                    {{-- <hr class="sm:hidden mb-10 w-1/3 border-2 align-middle mx-auto "> --}}
                    <div class="sticky top-24 space-y-3">
                        <livewire:ad id="1" />
                        <livewire:ad id="2" />
                    </div>
                </div>
            @endif
        </div>
    </main>

    <footer class="w-full">
        <div class="container md:px-0 px-5 py-2 mx-auto flex justify-between gap-5">
            <a href="/tentang"
                class="hover:underline underline-offset-4 decoration-yellow-400 decoration-2 md:text-base text-sm">
                Copyright© 2024 KBJT. All right reserved.
            </a>
            <div class="gap-2 justify-end md:flex hidden">
                <a href="#" target="_blank" class="hover:bg-yellow-400 p-1 rounded-md active:bg-yellow-300">
                    <i data-lucide="facebook" class="fill-black stroke-none"></i>
                </a>
                <a href="#" target="_blank" class="hover:bg-yellow-400 p-1 rounded-md active:bg-yellow-300">
                    <i data-lucide="twitter" class="fill-black stroke-none"></i>
                </a>
                <a href="#" target="_blank" class="hover:bg-yellow-400 p-1 rounded-md active:bg-yellow-300 group">
                    <i data-lucide="instagram"
                        class="fill-black stroke-white group-hover:stroke-yellow-400 group-active:stroke-yellow-300"></i>
                </a>
            </div>
        </div>
    </footer>

    <x-toast type="dispatch" />
    <x-toast type="session" />

    @livewireScripts
</body>

</html>
