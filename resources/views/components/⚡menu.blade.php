<?php

use Livewire\Component;
use Livewire\Attributes\Computed;

new class extends Component {
    //
    public $location = '';
    public function mount()
    {
        $path = request()->path();
        $this->location = explode('/', $path)[0];
    }

    #[Computed]
    public function menus()
    {
        // tipe pengguna
        $userRole = auth()->user()->role;
        $menus = [
            [
                'name' => 'Dashboard',
                'path' => '/dashboard',
                'icon' => 'layout-grid',
            ],
            [
                'name' => 'Notifikasi',
                'path' => '/notifikasi',
                'icon' => 'bell',
            ],
        ];

        if ($userRole == 'kontributor' || $userRole == 'pengurus') {
            $menus[] = [
                'name' => 'Kontribusi',
                'path' => '/kontribusi',
                'icon' => 'edit-2',
            ];
        }

        if ($userRole == 'pengurus' || $userRole == 'kepala') {
            $newMenus = [
                [
                    'name' => 'Artikel',
                    'path' => '/artikel',
                    'icon' => 'align-left',
                ],
                [
                    'name' => 'Statistik',
                    'path' => '/statistik',
                    'icon' => 'chart-pie',
                ],
                [
                    'name' => 'Iklan',
                    'path' => '/iklan',
                    'icon' => 'megaphone',
                ],
                [
                    'name' => 'Kontributor',
                    'path' => '/kontributor',
                    'icon' => 'users',
                ],
                [
                    'name' => 'Pengurus',
                    'path' => '/pengurus',
                    'icon' => 'user-round-key',
                ],
                [
                    'name' => 'Laporan',
                    'path' => '/laporan',
                    'icon' => 'flag-triangle-right',
                ],
            ];

            $menus = array_merge($menus, $newMenus);
        }

        if (auth()->user()->role == 'kepala') {
            $menus[] = [
                'name' => 'Level & Poin',
                'path' => '/level',
                'icon' => 'astroid',
            ];
        }

        $newMenus = [
            [
                'name' => 'Sertifikat',
                'path' => '/sertifikat',
                'icon' => 'signature',
            ],
            [
                'name' => 'Pencapaian',
                'path' => '/achievement',
                'icon' => 'award',
            ],
            [
                'name' => 'Pengaturan',
                'path' => '/pengaturan',
                'icon' => 'settings',
            ],
        ];
        $menus = array_merge($menus, $newMenus);

        return $menus;
    }
};
?>

<div class="">
    {{-- Menu --}}
    <div class="bg-white p-6 top-0 fixed left-0 h-full w-[17rem] hidden md:grid md:grid-row-12">
        {{-- logo --}}
        <div class="ml-4">
            <a href="/">
                <h4 class="font-bold underline decoration-amber-400 underline-offset-4 decoration-4">kbjt</h4>
            </a>
        </div>

        <div class="space-y-1 mt-5 overflow-y-auto row-span-10">
            @foreach ($this->menus as $menu)
                <a href="{{ $menu['path'] }}" class="group">
                    <div
                        class="flex items-center gap-3 p-4 w-fit rounded-xl
                    {{ $location == explode('/', $menu['path'])[1] ? 'bg-amber-100 text-neutral-800' : 'group-hover:bg-neutral-100 text-neutral-600' }}">
                        <i data-lucide='{{ $menu['icon'] }}'></i>
                        <div class="">{{ $menu['name'] }}</div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Beranda --}}
        <a href="/" class="flex items-end">
            <div class=" flex group py-3 px-4 rounded-xl">
                <i data-lucide='arrow-left' class="text-neutral-700 group-hover:text-black"></i>
                <div class="inline-block ml-3 text-neutral-700 group-hover:text-black">
                    Beranda
                </div>
            </div>
        </a>
    </div>

    {{-- menu mobile --}}
    <div id="menu" class="fixed w-full h-full grid grid-row-6 bg-white px-5 z-20 invisible">
        {{-- tutup menu --}}
        <div>
            <button onclick="toggleClass('menu', 'invisible')"
                class="mt-10 flex group px-6 py-4 w-fit rounded-2xl hover:bg-neutral-100 cursor-pointer space-x-3 active:bg-amber-100">
                <i data-lucide='x'></i>
                <div>Tutup</div>
            </button>
        </div>

        {{-- menu --}}
        <div class="space-y-1 overflow-y-auto row-span-4">
            {{-- Dashboard --}}
            @foreach ($this->menus as $menu)
                <a href="{{ $menu['path'] }}"
                    class="flex items-center gap-3 group py-4 px-6 w-fit rounded-2xl {{ $location == explode('/', $menu['path'])[1] ? 'bg-amber-100 text-neutral-800' : 'hover:bg-neutral-100 text-neutral-600' }}">
                    <i data-lucide='{{ $menu['icon'] }}'></i>
                    <div class="">{{ $menu['name'] }}</div>
                </a>
            @endforeach
        </div>

        {{-- Beranda --}}
        <a href="/" class="row-span-1">
            <div class=" flex group py-4 px-6 w-fit rounded-2xl hover:bg-neutral-100 active:bg-amber-100">
                <i data-lucide='arrow-left' class="text-neutral-700 group-hover:text-black"></i>
                <div class="inline-block ml-3 text-neutral-700 group-hover:text-black">
                    Beranda
                </div>
            </div>
        </a>

    </div>
</div>
