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
{{-- <nav class="w-full justify-between bg-white shadow-sm py-4 px-9 items-center flex sticky top-0 z-50"> --}}
{{-- Logo --}}
{{-- <div class="mr-16">
        <a href="/">
            <h4 class="font-bold underline decoration-yellow-400 underline-offset-4 decoration-4">kbjt</h4>
        </a>
    </div> --}}
{{-- Menu --}}
{{-- <div>
        <ul class="flex">
            <a href="/"
                class="px-4 py-2 hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4 active:bg-gray-50 active:rounded-full {{ $group == 'homepage' ? 'text-yellow-500 font-bold' : 'text-gray-700 hover:text-black' }}">
                <li>Home</li>
            </a>
            <a href="/daftar-kosakata"
                class="px-4 py-2 hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4 active:bg-gray-50 active:rounded-full {{ $group == 'kosakata' ? 'text-yellow-500 font-bold' : 'text-gray-700 hover:text-black' }}">
                <li>Kosakata</li>
            </a>
            <a href="/hall-of-fame"
                class="px-4 py-2 hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4 active:bg-gray-50 active:rounded-full {{ $group == 'hall of fame' ? 'text-yellow-500 font-bold' : 'text-gray-700 hover:text-black' }}">
                <li>Hall of Fame</li>
            </a>
            <a href="/blog"
                class="px-4 py-2 hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4 active:bg-gray-50 active:rounded-full {{ $group == 'blog' ? 'text-yellow-500 font-bold' : 'text-gray-700 hover:text-black' }}">
                <li>Blog</li>
            </a>
            <a href="/donasi"
                class="px-4 py-2 hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4 active:bg-gray-50 active:rounded-full {{ $group == 'donasi' ? 'text-yellow-500 font-bold' : 'text-gray-700 hover:text-black' }}">
                <li>Donasi</li>
            </a>
        </ul>
    </div>
    <div> --}}
{{-- Cek apakah sudah login --}}
{{-- @auth --}}
{{-- <a href="/dashboard">
                <div class="overflow-hidden md:w-10 md:h-10 w-12 h-12 rounded-full flex justify-center">
                    <img class="w-full h-full object-cover"
                        src="https://cdn.thefairnews.co.kr/news/photo/202404/25369_59232_5627.jpg" alt="Profile picture">
                </div> --}}
{{-- <div class="bg-yellow-300 w-10 h-10 rounded-full"></div> --}}
{{-- </a> --}}
{{-- @else --}}
{{-- <a href="/masuk"
                class="rounded-md py-2 px-5 bg-yellow-300 hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-yellow-400 active:bg-yellow-400">Masuk</a>
        @endauth
    </div>
</nav> --}}

{{-- daftar menu mobile --}}
<div id="menu" class="fixed w-full h-full grid grid-row-6 bg-white px-5 z-50 invisible">

    {{-- tutup menu --}}
    <div class="flex justify-between items-center row-span-1">
        <div class="translate-x-4">
            <a href="/">
                <h4 class="font-bold underline decoration-amber-400 underline-offset-4 decoration-4">kbjt</h4>
            </a>
        </div>

        <button onclick="closeWindow('menu')"
            class="flex group px-5 py-3 translate-x-2 w-fit rounded-2xl hover:bg-neutral-100 cursor-pointer space-x-3 active:bg-amber-100">
            <div>Tutup</div>
            <i data-feather='x'></i>
        </button>
    </div>

    {{-- menu --}}
    <div class="space-y-1 overflow-y-auto row-span-4">
        {{-- Home --}}
        <a href="/">
            <div
                class="flex group py-4 px-6 w-fit rounded-2xl {{ $group == 'homepage' ? 'bg-amber-100' : 'hover:bg-neutral-100' }}">
                <i data-feather='home'
                    class="{{ $group == 'homepage' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'homepage' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Home
                </div>
            </div>
        </a>

        @if ($title != 'Selamat datang di Kamus Bahasa Jawa Terbuka!')
        <a href="/cari">
            <div
                class="flex group py-4 px-6 w-fit rounded-2xl {{ $group == 'pencarian' ? 'bg-amber-100' : 'hover:bg-neutral-100' }}">
                <i data-feather='search'
                    class="{{ $group == 'pencarian' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'pencarian' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Pencarian
                </div>
            </div>
        </a>
        @endif

        {{-- Daftar kosakata --}}
        <a href="/daftar-kosakata">
            <div
                class="flex group py-4 px-6 w-fit rounded-2xl {{ $group == 'kosakata' ? 'bg-amber-100' : 'hover:bg-neutral-100' }}">
                <i data-feather='list'
                    class="{{ $group == 'kosakata' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'kosakata' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Daftar Kosakata
                </div>
            </div>
        </a>

        {{-- Hall of fame --}}
        <a href="/hall-of-fame">
            <div
                class="flex group py-4 px-6 w-fit rounded-2xl {{ $group == 'hall of fame' ? 'bg-amber-100' : 'hover:bg-neutral-100' }}">
                <i data-feather='award'
                    class="{{ $group == 'hall of fame' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'hall of fame' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Hall of Fame
                </div>
            </div>
        </a>

        {{-- blog --}}
        <a href="/blog">
            <div
                class="flex group py-4 px-6 w-fit rounded-2xl {{ $group == 'blog' ? 'bg-amber-100' : 'hover:bg-neutral-100' }}">
                <i data-feather='align-left'
                    class="{{ $group == 'blog' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div class="inline-block ml-3 {{ $group == 'blog' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Blog
                </div>
            </div>
        </a>

        {{-- donasi --}}
        <a href="/dukung">
            <div
                class="flex group py-4 px-6 w-fit rounded-2xl {{ $group == 'donasi' ? 'bg-amber-100' : 'hover:bg-neutral-100' }}">
                <i data-feather='gift'
                    class="{{ $group == 'donasi' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'donasi' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Dukung
                </div>
            </div>
        </a>
    </div>

    {{-- Masuk --}}
    <div class="row-span-1 flex items-center space-x-2">
        @auth
            <a href="/dashboard" class="">
                <button class="flex items-center group py-4 px-6 w-fit rounded-2xl hover:bg-neutral-100">
                    <div class="overflow-hidden w-7 h-7 rounded-full flex justify-center">
                        @include('partials.profile-pic')
                    </div>
                    <div class="inline-block ml-3 text-neutral-700 group-hover:text-black">
                        Dashboard
                    </div>
                </button>
            </a>
        @else
            <a href="/masuk" class="">
                <button class="flex group py-4 px-6 w-fit rounded-2xl bg-amber-100 hover:bg-amber-200 active:bg-amber-300">
                    <i data-feather='log-in' class="text-neutral-700 group-hover:text-black"></i>
                    <div class="inline-block ml-3 text-neutral-700 group-hover:text-black">
                        Masuk
                    </div>
                </button>
            </a>
        @endauth
    </div>
</div>


{{-- Navbar 3 --}}
<nav class="w-full justify-between bg-white shadow-sm py-4 px-9 items-center flex sticky top-0 z-10">
    {{-- Logo & pencarian --}}
    <div class="flex items-center space-x-8">
        {{-- logo --}}
        <div class="">
            <a href="/">
                <h4 class="font-bold underline decoration-amber-400 underline-offset-4 decoration-4">kbjt</h4>
            </a>
        </div>

        {{-- pencarian --}}
        @if ($title != 'Selamat datang di Kamus Bahasa Jawa Terbuka!')
            <form action="/cari" method="GET" class="md:block hidden">
                <div class="relative">
                    <input value="{{ request('keyword') }}" required
                        class="bg-neutral-100 w-96 px-5 py-2.5 pr-12 rounded-full hover:bg-white hover:outline hover:outline-2 hover:outline-amber-400 focus:outline focus:outline-amber-400 focus:outline-2 focus-within:bg-white"
                        name="keyword" id="keyword" type="text" placeholder="Cari...">
                    <button type="submit" class="absolute right-4 top-2.5 text-neutral-500 hover:text-amber-400"
                        title="Cari"><i data-feather='search'></i></button>
                </div>
            </form>
        @endif
    </div>

    {{-- menu desktop --}}
    <ul class="md:flex hidden items-center">
        <li>
            <a href="/"
                class="px-3.5 py-5 hover:rounded-full hover:underline hover:underline-offset-4 hover:decoration-4 hover:decoration-amber-400 {{ isset($group) && $group == 'homepage' ? 'text-amber-500 font-semibold' : 'text-neutral-700' }}">Home</a>
        </li>
        <li>
            <a href="/daftar-kosakata"
                class="px-3.5 py-5 hover:rounded-full hover:underline hover:underline-offset-4 hover:decoration-4 hover:decoration-amber-400 {{ isset($group) && $group == 'kosakata' ? 'text-amber-500 font-semibold' : 'text-neutral-700' }}">Daftar
                Kosakata</a>
        </li>
        <li>
            <a href="/hall-of-fame"
                class="px-3.5 py-5 hover:rounded-full hover:underline hover:underline-offset-4 hover:decoration-4 hover:decoration-amber-400 {{ isset($group) && $group == 'hall of fame' ? 'text-amber-500 font-semibold' : 'text-neutral-700' }}">Hall
                of
                Fame</a>
        </li>
        <li>
            <a href="/blog"
                class="px-3.5 py-5 hover:rounded-full hover:underline hover:underline-offset-4 hover:decoration-4 hover:decoration-amber-400 {{ isset($group) && $group == 'blog' ? 'text-amber-500 font-semibold' : 'text-neutral-700' }}">Blog</a>
        </li>
        <li>
            <a href="/dukung"
                class="px-3.5 py-5 hover:rounded-full hover:underline hover:underline-offset-4 hover:decoration-4 hover:decoration-amber-400 {{ isset($group) && $group == 'donasi' ? 'text-amber-500 font-semibold' : 'text-neutral-700' }}">Dukung</a>
        </li>
        <li>
            @auth
                <a href="/dashboard" title="Ke Dashboard">
                    <div
                        class="overflow-hidden ml-2 md:w-10 md:h-10 w-12 h-12 rounded-full flex justify-center hover:outline hover:outline-amber-400 hover:outline-offset-2 hover:outline-2">
                        @include('partials.profile-pic')
                    </div>
                </a>
            @else
                <a href="/masuk"
                    class="px-5 py-3 bg-amber-300 rounded-full hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-amber-400 active:bg-amber-400">Masuk</a>
            @endauth
        </li>
    </ul>

    {{-- button menu mobile --}}
    <button
        class="md:hidden w-12 h-12 rounded-full flex justify-center cursor-pointer items-center hover:bg-gray-200 active:bg-gray-300 translate-x-4"
        onclick="document.getElementById('menu').classList.toggle('invisible');">
        <i data-feather='menu'></i>
    </button>
</nav>
