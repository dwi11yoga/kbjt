<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\User;

new class extends Component {
    #[Title('Pengaturan')]
    #[Layout('layouts.dashboard')]
    public $profil;
    public $akun;

    public function mount()
    {
        // set nilai timezone
        $this->timezone = auth()->user()->timezone ?? 'Asia/Jakarta';

        // set daftar menu
        $this->profil = [
            [
                'text' => 'Ubah data diri',
                'icon' => 'user-round',
                'url' => '/pengaturan/edit-user',
            ],
            [
                'text' => 'Tautan dan media sosial',
                'icon' => 'link',
                'url' => '/pengaturan/tautan',
            ],
            [
                'text' => 'Sembunyikan data sensitif',
                'icon' => 'eye-off',
                'url' => '/pengaturan/data-sensitif',
            ],
            [
                'text' => 'Terima donasi',
                'icon' => 'heart-handshake',
                'url' => '/pengaturan/donasi',
            ],
        ];

        $menuAkun = [
            [
                'text' => 'Ubah username',
                'icon' => 'at-sign',
                'url' => 'pengaturan/ubah-username',
            ],
            [
                'text' => 'Ubah alamat email',
                'icon' => 'mail',
                'url' => '/pengaturan/ubah-email',
            ],
            [
                'text' => 'Ubah kata sandi',
                'icon' => 'key',
                'url' => '/pengaturan/ubah-password',
            ],
        ];

        if (auth()->user()->role != 'kepala') {
            $menuAkun[] = [
                'text' => 'Hapus akun',
                'icon' => 'user-x',
                'url' => '/pengaturan/hapus-akun',
            ];
        }

        $this->akun = $menuAkun;
    }

    // timezone
    #[Validate('in:Asia/Jakarta,Asia/Makassar,Asia/Jayapura')]
    public $timezone;
    public function updatedTimezone()
    {
        $this->validateOnly('timezone');
        User::find(auth()->user()->id)->update(['timezone' => $this->timezone]);
        $this->dispatch('notify', type: 'success', message: 'Preferensi zona waktu berhasil disimpan');
    }

    // logout
    public function logout()
    {
        sleep(4);
        Auth::logout(); // meng-logout-kan user
        request()->session()->invalidate(); //menghapus semua data session yang ada saat ini, mencegah session fixation attack.
        request()->session()->regenerateToken(); //mengganti CSRF token, Cross-Site Request Forgery
        return redirect()->to('/')->with('success', 'Anda berhasil keluar dari sistem');
    }
};
?>

<div class="space-y-4">

    {{-- Preferensi --}}
    <div class="rounded-2xl space-y-3">
        <div class="">Preferensi</div>
        <div class="space-y-2">

            {{-- mode gelap --}}
            <x-list-item type="div">
                <x-slot:leftText>
                    <div class="flex justify-between items-center w-full">
                        <div class="flex items-center gap-1">
                            <i data-lucide='moon-star' class="size-5"></i>
                            <div class="">Mode gelap</div>
                        </div>
                        <button class="cursor-pointer w-fit" onclick="darkmodeToggle()">
                            <x-badge>
                                <div class="dark:block hidden">Aktif</div>
                                <div class="dark:hidden block">Nonaktif</div>
                            </x-badge>
                        </button>
                    </div>
                </x-slot:leftText>
            </x-list-item>

            {{-- timezone --}}
            <x-list-item type="div">
                <x-slot:leftText>
                    <div class="flex justify-between items-center w-full">
                        <div class="flex items-center gap-1">
                            <i data-lucide='clock' class="size-5"></i>
                            <div class="">Zona waktu</div>
                        </div>
                        <x-radio-group model="timezone">
                            <x-input-radio style="3" model="timezone" id="wib" value="Asia/Jakarta"
                                text="WIB" />
                            <x-input-radio style="3" model="timezone" id="wita" value="Asia/Makassar"
                                text="WITA" />
                            <x-input-radio style="3" model="timezone" id="wit" value="Asia/Jayapura"
                                text="WIT" />
                        </x-radio-group>
                    </div>
                </x-slot:leftText>
            </x-list-item>
        </div>
    </div>

    {{-- profil --}}
    <div class="rounded-2xl space-y-3">
        <div class="">Profil</div>
        <div class="space-y-2">
            @foreach ($profil as $menu)
                <x-list-item type="url" url="{{ $menu['url'] }}">
                    <x-slot:leftText>
                        <i data-lucide='{{ $menu['icon'] }}' class="size-5"></i>
                        <div class="">{{ $menu['text'] }}</div>
                    </x-slot:leftText>
                </x-list-item>
            @endforeach
        </div>
    </div>

    {{-- akun --}}
    <div class="space-y-3">
        <div class="">Akun</div>
        <div class="space-y-2">
            @foreach ($akun as $menu)
                <x-list-item type="url" url="{{ $menu['url'] }}">
                    <x-slot:leftText>
                        <i data-lucide='{{ $menu['icon'] }}' class="size-5"></i>
                        <div class="">{{ $menu['text'] }}</div>
                    </x-slot:leftText>
                </x-list-item>
            @endforeach
            {{-- Keluar --}}
            <div wire:click='logout' class="cursor-pointer">
                <x-list-item type="div">
                    <x-slot:leftText>
                        <div class="animate-spin" wire:target='logout' wire:loading>
                            <i data-lucide='loader' class="size-5 text-red-600"></i>
                        </div>
                        <i wire:target='logout' wire:loading.remove data-lucide='log-out'
                            class="size-5 text-red-600"></i>
                        <div class="text-red-600">Keluar</div>
                    </x-slot:leftText>
                </x-list-item>
            </div>

        </div>
    </div>
</div>
