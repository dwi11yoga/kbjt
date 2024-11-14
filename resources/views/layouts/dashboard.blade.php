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
            <div class="col-span-1 col-start-2 items-start justify-end z-50 md:flex hidden">
                <div class="border border-gray-200 rounded-xl w-14 shadow-sm space-y-1 sticky top-10">
                    {{-- Dashboard --}}
                    <a href="#"
                        class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
                        <i data-feather='home'></i>
                        <div class="relative">
                            <div
                                class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                            </div>
                            <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                                Dashboard</div>
                        </div>
                    </a>

                    {{-- Kontribusi --}}
                    <a href="#"
                        class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
                        <i data-feather='edit-2'></i>
                        <div class="relative">
                            <div
                                class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                            </div>
                            <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                                Kontribusi</div>
                        </div>
                    </a>

                    {{-- Leaderboard --}}
                    <a href="#"
                        class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
                        <i data-feather='award'></i>
                        <div class="relative">
                            <div
                                class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                            </div>
                            <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                                Leaderboard</div>
                        </div>
                    </a>

                    {{-- Pengaturan --}}
                    <a href="#"
                        class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
                        <i data-feather='settings'></i>
                        <div class="relative">
                            <div
                                class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                            </div>
                            <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                                Pengaturan</div>
                        </div>
                    </a>

                    <hr class="h-px mx-auto w-3/5">

                    {{-- Logout sementara --}}
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" href="/logout"
                            class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400 cursor-pointer">
                            <i data-feather='log-out'></i>
                            <div class="relative">
                                <div
                                    class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                                </div>
                                <div
                                    class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                                    Logout</div>
                            </div>
                        </button>
                    </form>

                    {{-- Ke Beranda --}}
                    <a href="/"
                        class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
                        <i data-feather='arrow-left'></i>
                        <div class="relative">
                            <div
                                class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                            </div>
                            <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                                Beranda</div>
                        </div>
                    </a>
                </div>

            </div>

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
                        <p class="mr-4 text-right md:block hidden">Selamat datang, <span
                                class="font-bold">{{ auth()->user()->nama }}</span>
                        </p>
                        <div class="overflow-hidden md:w-14 md:h-14 w-12 h-12 rounded-full flex justify-center">
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
