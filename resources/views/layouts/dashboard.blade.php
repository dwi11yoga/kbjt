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

    {{-- Import custom --}}
    {{-- @yield('head') --}}

    {{-- Feathericon --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> --}}
</head>

<body class="relative">

    <div class="2xl:container 2xl:mx-auto">
        <div class="grid grid-cols-10">

            {{-- Menu --}}
            <livewire:menu />
            {{-- @include('partials.dashboard-menu') --}}

            {{-- Isi --}}
            <div class="md:col-span-8 md:col-start-3 col-span-12 md:ml-1 m-7">

                {{-- header --}}
                <div class="bg-white mb-5 md:py-0 py-2 md:static sticky top-0 flex items-center justify-between z-10">

                    <div class="flex md:translate-x-0 -translate-x-3 gap-1">
                        {{-- Menu mobile --}}
                        <button class="md:hidden z-40" onclick="toggleClass('menu', 'invisible')">
                            <div
                                class="w-12 h-12 rounded-full flex justify-center cursor-pointer items-center hover:bg-gray-200 active:bg-gray-300">
                                <i data-lucide='menu'></i>
                            </div>
                        </button>

                        {{-- Judul halaman --}}
                        <div class="md:col-span-5 col-span-4 flex items-center">
                            {{-- <h5>{{ $title }}</h5> --}}
                            <h5>{{ $title }} @yield('afterTitle')</h5>
                        </div>
                    </div>
                    {{-- foto profil --}}
                    <a href="/u/{{ auth()->user()->username }}"
                        class="rounded-full hover:outline outline-offset-2 outline-amber-400 outline-2">
                        <x-avatar avatarUrl="{{ auth()->user()->profile_pic }}" size="10" rounded="full" />
                        {{-- @include('partials.profile-pic') --}}
                    </a>
                </div>

                {{-- Konten --}}
                <div class="text-neutral-900 space-y-5">
                    {{ $slot ?? '' }}
                    @yield('slot')
                    @yield('body')
                </div>
                {{-- footerr --}}
                <div class="text-center text-xs text-neutral-600 p-2">Copyright © 2026 Kamus Bahasa Jawa Terbuka</div>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <x-toast type="session" />
    <x-toast type="dispatch" />
</body>

</html>
