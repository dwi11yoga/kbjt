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

<body>
    <div class="container mx-auto p-10">
        <div class="grid grid-cols-12 gap-5">

            {{-- Menu --}}
            @include('partials.dashboard-menu')

            {{-- Isi --}}
            <div class="md:col-span-9 col-span-12">

                {{-- Notifikasi & Foto profil --}}
                <div class="grid grid-cols-8 mb-5 bg-white md:py-0 py-2 md:static sticky top-0 flex items-center">

                    <div class="col-span-1 md:hidden">
                        <div
                            class="mr-1 bg-gray-100 w-12 h-12 rounded-full flex justify-center cursor-pointer items-center hover:bg-gray-200 active:bg-gray-300">
                            <i data-feather='menu'></i>
                        </div>
                    </div>

                    <div class="md:col-span-1 col-span-2 col-start-6 flex md:justify-start justify-end mr-2">
                        <a href="#"
                            class="group bg-gray-100 w-12 h-12 rounded-full flex justify-center items-center hover:bg-gray-200 active:bg-gray-300">
                            <i data-feather='bell' class="group-active:fill-yellow-300"></i>
                        </a>
                    </div>

                    <div class="md:col-span-7 col-span-1 flex justify-end items-center">
                        <p class="mr-4 text-right md:block hidden">
                            {{ auth()->user()->nama }}<br>
                            {{-- <span class="text-sm bg-yellow-100 rounded-md py-1 px-2">Lv.{{ $userProgress['lvl'] }}</span> --}}
                        </p>
                        <div class="overflow-hidden w-12 h-12 rounded-full flex justify-center">
                            <img class="w-full h-full object-cover"
                                src="https://cdn.thefairnews.co.kr/news/photo/202404/25369_59232_5627.jpg"
                                alt="Profile picture">
                        </div>
                    </div>

                </div>

                @yield('body')
            </div>
        </div>
    </div>

    {{-- Feathericon --}}
    <script>
        feather.replace();
    </script>
</body>

</html>
