<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Banner;

new class extends Component {
    #[Title('Banner')]
    #[Layout('layouts.dashboard')]
    #[Computed]
    public function banners()
    {
        $banner = Banner::with([
            'user' => function ($query) {
                $query->withTrashed(); //ambil data softdelete juga
            },
        ])
            ->get()
            ->keyBy('id');

        // cek apakah data user (author) ada/terhapus
        foreach ($banner as $d) {
            if (isset($d->user) && $d->user->trashed()) {
                $d->user->statusUser = 'dihapus';
            }
        }

        return $banner;
    }

    // buka window edit
    public $openEdit = false;
    public $bannerId; // id banner dihapus

    protected $listeners = ['editToggle' => 'editToggle'];
    public function editToggle(int $id)
    {
        $this->bannerId = $this->bannerId != $id ? $id : null;
        $this->openEdit = !$this->openEdit;
    }
};
?>

<div class="space-y-5">

    {{-- sidebar --}}
    <div class="">
        <div class="mb-3">Sidebar</div>
        <div class="grid grid-cols-6 md:space-x-4 md:space-y-0 space-y-4">
            {{-- contoh konten --}}
            <div class="md:col-span-4 col-span-6 animate-pulse space-y-2">
                <div class="w-full h-52 bg-gray-200 dark:bg-zinc-800 rounded-xl flex items-center justify-center">
                    <i data-lucide='image' class="size-5"></i>
                </div>
                <div class="h-5 mb-5 w-1/2 bg-gray-200 dark:bg-zinc-800 rounded-full"></div>
                <div class="h-4 bg-gray-200 dark:bg-zinc-800 rounded-full"></div>
                <div class="h-4 bg-gray-200 dark:bg-zinc-800 rounded-full"></div>
                <div class="h-4 bg-gray-200 dark:bg-zinc-800 rounded-full"></div>
                <div class="h-4 w-3/4 bg-gray-200 dark:bg-zinc-800 rounded-full"></div>

                <div class="flex space-x-3">
                    {{-- pulse gambar bawah --}}
                    @for ($i = 0; $i < 3; $i++)
                        <div class="w-1/3 h-52 bg-gray-200 dark:bg-zinc-800 rounded-xl flex items-center justify-center">
                            <i data-lucide='image' class="size-5"></i>
                        </div>
                    @endfor
                </div>
            </div>

            {{-- iklan/banner --}}
            <div class="md:col-span-2 col-span-6 space-y-3">
                {{-- banner 1 --}}
                <x-banner-item :banner="$this->banners[1]" modelEdit="editToggle(1)" />
                {{-- banner 2 --}}
                <x-banner-item :banner="$this->banners[2]" modelEdit="editToggle(2)" />
            </div>
        </div>
    </div>

    {{-- banner artikel --}}
    <div class="">
        <div class="mb-3">Artikel</div>
        <div class="space-y-3">

            {{-- layout --}}
            <div class="w-full animate-pulse">
                {{-- author --}}
                <div class="flex items-center space-x-2 !mb-3">
                    <div class="h-8 w-8 rounded-full bg-gray-200 dark:bg-zinc-800"></div>
                    <div class="ml-2 w-32 h-4 bg-gray-200 dark:bg-zinc-800 rounded-full"></div>
                </div>

                {{-- Judul --}}
                <div class="mb-2 rounded-full h-6 w-full bg-gray-200 dark:bg-zinc-800"></div>
                <div class="!mb-3 rounded-full h-6 w-2/3 bg-gray-200 dark:bg-zinc-800"></div>
                {{-- subjudul --}}
                <div class="rounded-full h-4 w-1/2 bg-gray-200 dark:bg-zinc-800 mb-2"></div>

                {{-- Waktu --}}
                <div class="flex items-center space-x-2">
                    <div class="rounded-full h-4 w-24 bg-gray-200 dark:bg-zinc-800"></div>
                    <div class="rounded-full h-4 w-24 bg-gray-200 dark:bg-zinc-800"></div>
                </div>

                {{-- Thumbnail --}}
                <div class="w-full h-52 bg-gray-200 dark:bg-zinc-800 rounded-xl flex items-center justify-center mb-5 mt-4">
                    <i data-lucide='image' class="size-5"></i>
                </div>
            </div>

            {{-- banner 3 (artikel atas) --}}
            <x-banner-item :banner="$this->banners[3]" modelEdit="editToggle(3)" />

            {{-- layout --}}
            <div class="w-full animate-pulse">
                {{-- Isi Blog --}}
                <div class="space-y-3 my-5">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="h-4 bg-gray-200 dark:bg-zinc-800 rounded-full"></div>
                    @endfor
                    <div class="h-4 bg-gray-200 dark:bg-zinc-800 w-1/2 rounded-full !mb-4"></div>
                    @for ($i = 0; $i < 3; $i++)
                        <div class="h-4 bg-gray-200 dark:bg-zinc-800 rounded-full"></div>
                    @endfor
                    <div class="h-4 bg-gray-200 dark:bg-zinc-800 w-1/3 rounded-full !mb-4"></div>
                </div>
            </div>

            {{-- banner 4 (artikel bawah) --}}
            <x-banner-item :banner="$this->banners[4]" modelEdit="editToggle(4)" />
        </div>
    </div>

    {{-- definisi kosakata --}}
    <div class="">
        <div class="mb-3">Definisi kosakata</div>
        <div class="space-y-3">

            {{-- layout --}}
            <div class="w-full animate-pulse">
                <div class="border-neutral-200 dark:border-zinc-800 border rounded-xl p-5 space-y-3">
                    <div class="flex justify-between">
                        <h4 class="bg-gray-200 dark:bg-zinc-800 rounded-full w-1/2"></h4>
                        <div class="p-2 rounded-full bg-gray-200 dark:bg-zinc-800 w-8 h-8"></div>
                    </div>

                    <div class="p-2 rounded-full bg-gray-200 dark:bg-zinc-800 w-1/6"></div>
                    <div class="p-2 rounded-full bg-gray-200 dark:bg-zinc-800 w-1/3"></div>

                    <div class="md:flex block md:space-x-2 space-x-0 md:space-y-0 space-y-2 items-center mt-1">
                        <div class="flex space-x-2">
                            <div class="p-2 rounded-full bg-gray-200 dark:bg-zinc-800 h-8 w-16"></div>
                            <div class="p-2 rounded-full bg-gray-200 dark:bg-zinc-800 h-8 w-16"></div>
                        </div>

                        <div class="flex space-x-2 items-center">
                            <div class="h-8 w-8 rounded-full z-20 bg-gray-200 dark:bg-zinc-800"></div>
                            <div class="p-2 rounded-full bg-gray-200 dark:bg-zinc-800 w-20"></div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- banner 5 (kosakata atas) --}}
            <x-banner-item :banner="$this->banners[5]" modelEdit="editToggle(5)" />

            {{-- definisi --}}
            @for ($i = 0; $i < 3; $i++)
                <div class="w-full animate-pulse">

                    <div class="border-neutral-200 dark:border-zinc-800 border rounded-xl p-5 space-y-3">
                        {{-- Kosakata --}}
                        <div class="bg-gray-200 dark:bg-zinc-800 h-6 rounded-full w-1/2"></div>

                        {{-- Definisi --}}
                        <div class="mb-3 space-y-1">
                            <div class="bg-gray-200 dark:bg-zinc-800 h-4 rounded-full w-3/4"></div>
                            <div class="bg-gray-200 dark:bg-zinc-800 h-4 rounded-full w-1/3"></div>
                        </div>

                        {{-- Referensi --}}
                        <div class="mt-4 space-y-1">
                            <div class="bg-gray-200 dark:bg-zinc-800 h-4 rounded-full w-16"></div>
                            <ul class="list-inside  space-y-2">
                                <li class="bg-gray-200 dark:bg-zinc-800 h-4 rounded-full w-1/4"></li>
                            </ul>
                        </div>

                        {{-- Author --}}
                        <div class="space-y-1">
                            <div class="bg-gray-200 dark:bg-zinc-800 h-4 rounded-full w-20"></div>
                            <div class="flex items-center space-x-2">
                                <div class="bg-gray-200 dark:bg-zinc-800 h-10 w-10 rounded-full"></div>
                                <div class="bg-gray-200 dark:bg-zinc-800 h-4 rounded-full w-24"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

            {{-- banner 6 (kosakata bawah) --}}
            <x-banner-item :banner="$this->banners[6]" modelEdit="editToggle(6)" />
        </div>
    </div>

    {{-- dashboard --}}
    <div class="">
        <div class="mb-3">Dashboard</div>
        <div class="space-y-3">

            {{-- banner 7 (dashboard atas) --}}
            <x-banner-item :banner="$this->banners[7]" modelEdit="editToggle(7)" />
            {{-- layout --}}
            <div class="w-full animate-pulse mt-2">
                <div class="space-y-3">
                    <div class="rounded-full h-4 bg-gray-200 dark:bg-zinc-800 w-1/4"></div>
                    <div class="grid grid-cols-3 gap-3 ">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="md:col-span-1 col-span-3 border border-neutral-200 dark:border-zinc-800 rounded-xl space-y-1 p-5">
                                <div class="rounded-full h-4 bg-gray-200 dark:bg-zinc-800 w-1/3"></div>
                                <div class="rounded-full h-12 bg-gray-200 dark:bg-zinc-800 w-1/5"></div>
                                <div class="rounded-full h-3 bg-gray-200 dark:bg-zinc-800 w-1/2"></div>
                            </div>
                        @endfor
                    </div>

                    <div class="border border-neutral-200 dark:border-zinc-800 rounded-xl space-y-3 p-5">
                        <div class="rounded-full h-4 bg-gray-200 dark:bg-zinc-800 w-1/4"></div>
                        <div class="rounded-full h-6 bg-gray-200 dark:bg-zinc-800 w-full"></div>
                        <div class="rounded-full h-6 bg-gray-200 dark:bg-zinc-800 w-full"></div>
                        <div class="rounded-full h-6 bg-gray-200 dark:bg-zinc-800 w-full"></div>
                        <div class="rounded-full h-6 bg-gray-200 dark:bg-zinc-800 w-full"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- window edit --}}
    @if ($openEdit)
        <livewire:banner-edit :banner="$this->banners[$bannerId]" />
    @endif
</div>
