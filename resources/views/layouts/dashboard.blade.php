<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | Kamus Besar Bahasa Jawa</title>

    {{-- Import CSS --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Import font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- Feathericon --}}
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>

<body class="bg-neutral-50 relative">
    <div class="2xl:container 2xl:mx-auto">
        <div class="grid grid-cols-10">

            {{-- Menu --}}
            <div class="bg-white p-6 border-r border-neutral-200 top-0 fixed left-0 h-screen w-[17rem]">
                @include('partials.dashboard-menu')
            </div>

            {{-- Isi --}}
            <div class="md:col-span-8 md:col-start-3 col-span-12 m-7">

                {{-- header --}}
                <div class="grid grid-cols-8 space-x-1 mb-5 md:py-0 py-2 md:static sticky top-0 flex items-center">

                    {{-- Menu mobile --}}
                    <div class="col-span-1 md:hidden">
                        <div
                            class="w-12 h-12 rounded-full flex justify-center cursor-pointer items-center hover:bg-gray-200 active:bg-gray-300">
                            <i data-feather='menu'></i>
                        </div>
                    </div>

                    {{-- Judul halaman --}}
                    <div class="md:col-span-5 col-span-4">
                        <h5>{{ $title }}</h5>
                    </div>

                    {{-- Profil & notifikasi --}}
                    <div class="md:col-span-3 col-span-3 flex justify-end items-center">
                        {{-- <p class="mr-4 text-right md:block hidden">
                            {{ auth()->user()->nama }}<br>
                        </p> --}}
                        <a href="#"
                            class="group mr-2 w-10 h-10 rounded-full flex justify-center items-center hover:bg-gray-100 active:bg-gray-300">
                            <i data-feather='bell' class="group-active:fill-black"></i>
                        </a>

                        <div class="overflow-hidden w-10 h-10 rounded-full flex justify-center">
                            @include('partials.profile-pic')
                        </div>
                    </div>

                    {{-- <div class="md:col-span-1 col-span-2 col-start-6 flex md:justify-start justify-end mr-2">
                        <a href="#"
                            class="group bg-gray-100 w-12 h-12 rounded-full flex justify-center items-center hover:bg-gray-200 active:bg-gray-300">
                            <i data-feather='bell' class="group-active:fill-amber-300"></i>
                        </a>
                    </div> --}}

                </div>

                {{-- Konten --}}
                <div class="text-neutral-900 space-y-5">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>

    {{-- Feathericon --}}
    <script>
        feather.replace();
    </script>
</body>

</html>
