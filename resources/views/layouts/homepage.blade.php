<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>kbjt</title>

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
    {{-- Navbar 1 --}}
    {{-- <div class="container fixed top-4">
        <nav id="navbar" class="w-full rounded-full z-50 relative inset-x-0 mx-auto bg-white max-w-max shadow-md">
            <ul class="flex justify-center">
                <a href="#" class="border-2 border-white rounded-full hover:border-2 hover:border-yellow-400">
                    <li class="px-7 py-4">Home</li>
                </a>
                <a href="/daftar-kosakata"
                    class="border-2 border-white rounded-full hover:border-2 hover:border-yellow-400">
                    <li class="px-7 py-4">Daftar Kosakata</li>
                </a>
                <a href="#" class="border-2 border-white rounded-full hover:border-2 hover:border-yellow-400">
                    <li class="px-7 py-4">Hall of Fame</li>
                </a>
                <a href="#" class="border-2 border-white rounded-full hover:border-2 hover:border-yellow-400">
                    <li class="px-7 py-4">Blog</li>
                </a>
                <a href="#" class="border-2 border-white rounded-full hover:border-2 hover:border-yellow-400">
                    <li class="px-7 py-4">Donasi</li>
                </a>
                <a href="#">
                    <li
                        class="px-7 py-4 rounded-full border-2 border-yellow-400 bg-yellow-400 hover:bg-black hover:border-black hover:text-white">
                        Masuk
                    </li>
                </a>
            </ul>
            <div class="flex absolute rounded-full bg-green-500 py-4 px-6 z-50 top-0 -right-20 shadow-md">A</div>
        </nav>
    </div> --}}

    {{-- Navbar 2 --}}
    <nav class="w-full justify-between bg-white shadow-sm py-4 px-9 items-center flex sticky top-0 z-50">
        {{-- Logo --}}
        <div class="mr-16">
            <a href="/">
                <h4 class="font-bold underline decoration-yellow-400 underline-offset-4 decoration-4">kbjt</h4>
            </a>
        </div>
        {{-- Menu --}}
        <div>
            <ul class="flex">
                <a href="/"
                    class="font-bold text-yellow-500 px-4 py-2 hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4 active:bg-gray-50 active:rounded-full">
                    <li>Home</li>
                </a>
                <a href="/daftar-kosakata"
                    class="text-gray-700 px-4 py-2 hover:text-black hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4 active:bg-gray-50 active:rounded-full">
                    <li>Kosakata</li>
                </a>
                <a href="#"
                    class="text-gray-700 px-4 py-2 hover:text-black hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4 active:bg-gray-50 active:rounded-full">
                    <li>Hall of Fame</li>
                </a>
                <a href="#"
                    class="text-gray-700 px-4 py-2 hover:text-black hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4 active:bg-gray-50 active:rounded-full">
                    <li>Blog</li>
                </a>
                <a href="#"
                    class="text-gray-700 px-4 py-2 hover:text-black hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4 active:bg-gray-50 active:rounded-full">
                    <li>Donasi</li>
                </a>
            </ul>
        </div>
        <div>
            {{-- Belum login --}}
            <a href="#"
                class="rounded-md border-yellow-400 border-2 py-2 px-5 bg-yellow-400 hover:bg-yellow-300 hover:border-yellow-300 active:bg-gray-50">Masuk</a>
            {{-- Sudah login --}}
            <div class="hidden bg-yellow-300 w-10 h-10 rounded-full"></div>
        </div>
    </nav>

    {{-- Content --}}
    @yield('body')

    {{-- footer --}}
    <footer>
        <div class="grid grid-cols-12 py-4">
            <div class="col-span-7 md:col-span-8 pl-9">
                <span
                    class="hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-2">Copyright
                    © 2024 Dwi Yoga Yulian Nugroho. All right reserved.</span>
            </div>
            <div class="col-span-5 md:col-span-4 flex space-x-2 justify-end pr-9">
                <a href="#" target="_blank" class="hover:bg-yellow-400 p-1 rounded-md active:bg-yellow-300">
                    <i data-feather="facebook" class="fill-black stroke-none"></i>
                </a>
                <a href="#" target="_blank" class="hover:bg-yellow-400 p-1 rounded-md active:bg-yellow-300">
                    <i data-feather="twitter" class="fill-black stroke-none"></i>
                </a>
                <a href="#" target="_blank" class="hover:bg-yellow-400 p-1 rounded-md active:bg-yellow-300">
                    <i data-feather="instagram"
                        class="fill-black stroke-white hover:stroke-yellow-400 active:stroke-yellow-300"></i>
                </a>
            </div>
        </div>
    </footer>

    {{-- Feathericon --}}
    <script>
        feather.replace();
    </script>
</body>

</html>
