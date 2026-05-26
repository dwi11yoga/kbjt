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
<nav class="w-full bg-white shadow-sm py-4 px-9 sticky top-0 z-50">
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
        <ul class="lg:flex hidden items-center">
            @foreach ($menus as $menu)
                <li>
                    <a href="{{ $menu['url'] }}"
                        class="px-3.5 py-5 hover:rounded-full hover:underline hover:underline-offset-4 hover:decoration-4 hover:decoration-amber-400 {{ $menu['name'] == 'Pencarian' ? 'lg:hidden' : '' }} {{ $location == explode('/', $menu['url'])[1] ? 'text-amber-500 font-semibold' : 'text-neutral-700' }}">
                        {{ $menu['name'] }}
                    </a>
                </li>
            @endforeach
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
                        class="px-4 py-2 bg-amber-300 rounded-full hover:bg-neutral-800 hover:text-white active:bg-amber-400 transition-all ease-in-out">
                        Masuk
                    </a>
                @endauth
            </li>
        </ul>

        {{-- button menu mobile --}}
        <button
            class="lg:hidden w-10 h-10 rounded-full flex justify-center cursor-pointer items-center hover:bg-gray-200 active:bg-gray-300 translate-x-4"
            onclick="document.getElementById('menu').classList.toggle('hidden');">
            <i data-lucide='menu' class="size-5"></i>
        </button>
    </div>

    {{-- MOBILE --}}
    <div id="menu" class="fixed top-0 left-0 w-full h-full bg-white px-5 z-50 hidden space-y-5 mt-5">

        {{-- tutup menu --}}
        <div class="flex justify-between items-center">
            <a href="/" class="translate-x-4">
                <h4
                    class="font-bold md:text-2xl text-lg underline decoration-amber-400 underline-offset-4 decoration-4">
                    kbjt</h4>
            </a>

            <button onclick="document.getElementById('menu').classList.toggle('hidden');"
                class="flex group px-4 py-2 items-center translate-x-2 w-fit rounded-full hover:bg-neutral-100 cursor-pointer space-x-3 active:bg-amber-100">
                <div>Tutup</div>
                <i data-lucide='x' class="size-5"></i>
            </button>
        </div>

        {{-- menu --}}
        <div class="space-y-1 overflow-y-auto">
            {{-- Home --}}
            @foreach ($menus as $menu)
                <a href="{{ $menu['url'] }}"
                    class="flex group py-4 px-6 w-fit rounded-2xl {{ $location == explode('/', $menu['url'])[1] ? 'bg-amber-100 font-semibold' : '' }}">
                    <i data-lucide='{{ $menu['icon'] }}'></i>
                    <div class="inline-block ml-3">
                        {{ $menu['name'] }}
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Masuk --}}
        <div class="flex items-center">
            @auth
                <a href="/dashboard" class="flex items-center group py-4 px-6 w-fit rounded-2xl hover:bg-neutral-100">
                    <div class="overflow-hidden w-7 h-7 rounded-full flex justify-center">
                        @include('partials.profile-pic')
                    </div>
                    <div class="inline-block ml-3 text-neutral-700 group-hover:text-black">
                        Dashboard
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
