<?php

use Livewire\Component;
use Illuminate\Http\Request;

new class extends Component {
    public $location = '';
    public function mount(Request $request)
    {
        $path = $request->path();
        $this->location = explode('/', $path)[0];
    }

    // dafar menu
    public $menus = [
        [
            'name' => 'Home',
            'url' => '/',
            'icon' => 'home',
        ],
        [
            'name' => 'Pencarian',
            'url' => '/cari',
            'icon' => 'search',
        ],
        [
            'name' => 'Alih aksara',
            'url' => '/alih-aksara',
            'icon' => 'languages',
        ],
        [
            'name' => 'Daftar kosakata',
            'url' => '/kosakata',
            'icon' => 'text-align-start',
        ],
        [
            'name' => 'Hall of Fame',
            'url' => '/hall-of-fame',
            'icon' => 'flame',
        ],
        [
            'name' => 'Blog',
            'url' => '/blog',
            'icon' => 'file-text',
        ],
    ];
};
?>

{{-- navbar --}}
<nav class="w-full bg-white dark:bg-zinc-900 shadow-sm py-4 px-9 sticky top-0 z-50">
    {{-- DESKTOP --}}
    <div class="container mx-auto flex items-center justify-between">
        {{-- Logo & pencarian --}}
        <div class="flex items-center space-x-8">
            {{-- logo --}}
            <div class="">
                <a href="/">
                    <h4
                        class="font-bold md:text-2xl text-lg underline decoration-amber-400 underline-offset-4 decoration-4">
                        kbjt
                    </h4>
                </a>
            </div>

            {{-- pencarian --}}
            @if ($location != '')
                <div class="lg:block hidden">
                    <livewire:search />
                </div>
            @endif
        </div>

        {{-- Menu --}}
        <div class="lg:flex hidden items-center gap-4">
            @foreach ($menus as $menu)
                <a href="{{ $menu['url'] }}"
                    class="hover:rounded-full hover:underline hover:underline-offset-4 hover:decoration-4 hover:decoration-amber-400 {{ $menu['name'] == 'Pencarian' ? 'lg:hidden' : '' }} {{ $location == explode('/', $menu['url'])[1] ? 'text-amber-500 font-semibold' : 'text-neutral-700 dark:text-zinc-300' }}">
                    {{ $menu['name'] }}
                </a>
            @endforeach
            {{-- darkmode toggle --}}
            <button class="rounded-full p-3 hover:bg-neutral-100 dark:hover:bg-zinc-800 aspect-square"
                title="Mode gelap" onclick="darkmodeToggle()">
                <i data-lucide='moon' class="size-5 dark:hidden"></i>
                <i data-lucide='sun' class="size-5 dark:block hidden"></i>
            </button>
            <div>
                @auth
                    <a href="/dashboard" class="rounded-full hover:outline outline-offset-2 outline-amber-400 outline-2">
                        <x-avatar avatarUrl="{{ auth()->user()->profile_pic }}" size="10" rounded="full" />
                        {{-- @include('partials.profile-pic') --}}
                    </a>
                @else
                    <x-button text="Masuk" url="/masuk" />
                    {{-- <a href="/masuk"
                        class="px-4 py-2 bg-amber-300 rounded-full hover:bg-neutral-800 hover:text-white active:bg-amber-400 transition-all ease-in-out">
                        Masuk
                    </a> --}}
                @endauth
            </div>
        </div>

        {{-- button menu mobile --}}
        <button
            class="lg:hidden w-10 h-10 rounded-full flex justify-center cursor-pointer items-center hover:bg-gray-200 dark:hover:bg-zinc-700 active:bg-gray-300 translate-x-4"
            onclick="document.getElementById('menu').classList.toggle('hidden');">
            <i data-lucide='menu' class="size-5"></i>
        </button>
    </div>

    {{-- MOBILE --}}
    <div id="menu"
        class="fixed top-0 left-0 w-full h-full bg-white dark:bg-zinc-900 px-5 z-50 hidden space-y-5 mt-5">

        {{-- tutup menu --}}
        <div class="flex justify-between items-center">
            <a href="/" class="translate-x-4">
                <h4
                    class="font-bold md:text-2xl text-lg underline decoration-amber-400 underline-offset-4 decoration-4">
                    kbjt</h4>
            </a>

            <button onclick="document.getElementById('menu').classList.toggle('hidden');"
                class="flex group px-4 py-2 items-center translate-x-2 w-fit rounded-full hover:bg-neutral-100 dark:hover:bg-zinc-700 cursor-pointer space-x-3 active:bg-amber-100">
                <div>Tutup</div>
                <i data-lucide='x' class="size-5"></i>
            </button>
        </div>

        {{-- menu --}}
        <div class="space-y-1 overflow-y-auto">
            {{-- Home --}}
            @foreach ($menus as $menu)
                <a href="{{ $menu['url'] }}"
                    class="flex gap-3 group py-4 px-6 w-fit rounded-2xl {{ $location == explode('/', $menu['url'])[1] ? 'bg-amber-100 dark:text-zinc-900 font-semibold' : '' }}">
                    <i data-lucide='{{ $menu['icon'] }}'></i>
                    <div class="inline-block">
                        {{ $menu['name'] }}
                    </div>
                </a>
            @endforeach
        </div>

        {{-- darkmode toggle --}}
        <button class="flex group py-4 px-6 w-fit rounded-2xl gap-3 items-center" title="Mode gelap"
            onclick="darkmodeToggle()">

            <i data-lucide='moon' class="dark:hidden"></i>
            <div class="dark:hidden">Mode gelap</div>
            <i data-lucide='sun' class="dark:block hidden"></i>
            <div class="dark:block hidden">Mode terang</div>
        </button>

        {{-- Masuk --}}
        <div class="flex items-center">
            @auth
                <a href="/dashboard"
                    class="flex items-center group p-4 gap-2 w-fit rounded-2xl hover:bg-neutral-100">
                    {{-- <x-avatar avatarUrl="{{ auth()->user()->profile_pic }}" size="10" rounded="full" /> --}}
                    <x-avatar avatarUrl="{{ auth()->user()->profile_pic }}" size="10" rounded="full" />
                    <div class="">
                        Dashboard
                    </div>
                </a>
            @else
                <a href="/masuk"
                    class="flex group py-4 px-6 w-fit rounded-2xl bg-amber-100 hover:bg-amber-200 active:bg-amber-300">
                    <i data-lucide='log-in' class="text-neutral-700 group-hover:text-black"></i>
                    <div class="inline-block ml-3 text-neutral-700 group-hover:text-black">
                        Masuk
                    </div>
                </a>
            @endauth
        </div>
    </div>
</nav>
