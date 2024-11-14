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
    <div>
        {{-- Cek apakah sudah login --}}
        @auth
            <a href="/dashboard">
                <div class="overflow-hidden md:w-10 md:h-10 w-12 h-12 rounded-full flex justify-center">
                    <img class="w-full h-full object-cover"
                        src="https://cdn.thefairnews.co.kr/news/photo/202404/25369_59232_5627.jpg" alt="Profile picture">
                </div>
                {{-- <div class="bg-yellow-300 w-10 h-10 rounded-full"></div> --}}
            </a>
        @else
            <a href="/masuk"
                class="rounded-md py-2 px-5 bg-yellow-300 hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-yellow-400 active:bg-yellow-400">Masuk</a>
        @endauth
    </div>
</nav>
