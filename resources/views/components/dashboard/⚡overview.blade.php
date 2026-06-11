<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Level;

new class extends Component {
    //
    #[Computed]
    public function progress()
    {
        // level saat ini
        $level = levelCalculator(auth()->user()->poin);
        // dapatkan req lvl saat ini dan level selanjutnya
        $currentLevelReq = Level::where('lvl', $level)->first()->min_poin;
        $nextLevelReq = Level::where('lvl', $level + 1)->first()?->min_poin;
        // cek apakah level selanjutnya ada (artinya pengguna sudah level max)
        $unavailableNextLvl = $nextLevelReq === null;

        // cek progress (persen)
        $progress = $unavailableNextLvl ? 100 : ((auth()->user()->poin - $currentLevelReq) / ($nextLevelReq - $currentLevelReq)) * 100;
        $progress = intval($progress); // bulatkan

        // cek req poin untuk melaju ke lvl selanjutnya
        $reqPoint = $unavailableNextLvl ? null : $nextLevelReq - auth()->user()->poin;
        // dd($level, $currentLevelReq, $nextLevelReq, $progress, $reqPoint);
        return [
            'level' => $level,
            'percent' => $progress,
            'reqPoint' => $reqPoint,
        ];
    }
};
?>

<div class="grid grid-cols-3 gap-2">

    {{-- profil --}}
    <div class="col-span-3 md:col-span-1">
        <x-bento-item title="Profil" urlText="Lihat profil" url="/u/{{ auth()->user()->username }}">
            <div class="flex flex-col justify-center items-center gap-4 mt-4">
                {{-- foto profil --}}
                <div class="flex justify-center">
                    <x-avatar avatarUrl="{{ auth()->user()->profile_pic }}" rounded="full" size="20" />
                </div>

                {{-- nama --}}
                <div class="text-center">
                    <div class="font-semibold">{{ auth()->user()->nama }}</div>
                    <div class="capitalize text-neutral-600 text-sm -mt-1">{{ auth()->user()->role }}</div>
                </div>

                {{-- popularitas --}}
                <div class="flex justify-center">
                    <div class="cursor-pointer dark:bg-zinc-800 bg-neutral-200 rounded-full px-2 py-1 text-sm"
                        title="Jumlah kunjungan ke akun kamu">🔥 {{ number_format(auth()->user()->view, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </x-bento-item>
    </div>

    <div class="md:col-span-2 col-span-3 space-y-2">
        {{-- level & poin --}}
        <div class="grid grid-cols-2 gap-2">
            {{-- Level --}}
            <x-bento-item title="Level"
                value="{{ auth()->user()->role == 'kepala' ? '∞' : $this->progress['level'] }}">
                {{-- <h1 class="font-bold">
                    {{ auth()->user()->role == 'kepala' ? '∞' : $this->progress['level'] }}</h1> --}}
                <div class="relative mb-3">
                    <div class="absolute top-0 w-full bg-neutral-300 h-2 rounded-full"></div>
                    <div title="{{ $this->progress['percent'] }}%"
                        class="absolute top-0 min-w-[2%] bg-amber-400 h-2 rounded-full hover:outline hover:outline-4 hover:outline-amber-400"
                        style="width: {{ auth()->user()->role == 'kepala' ? '100' : $this->progress['percent'] }}%">
                    </div>
                </div>
                <div class="text-sm">
                    @if (auth()->user()->role == 'kepala')
                        <span>Sebagai kepala, kamu tidak bisa naik level!</span>
                        {{-- <span>∞</span> --}}
                    @elseif ($this->progress['reqPoint'] != null)
                        <span>{{ $this->progress['percent'] }}%</span>
                    @else
                        Kamu telah mencapai level maksimal 🙌
                    @endif
                </div>
            </x-bento-item>
            {{-- Poin --}}
            <x-bento-item title="Poin"
                value="{{ auth()->user()->role == 'kepala' ? '∞' : number_format(auth()->user()->poin, 0, ',', '.') }}"
                footnote="{{ auth()->user()->role === 'kepala'
                    ? 'Sebagai kepala, kamu tidak memiliki poin kontribusi!'
                    : ($this->progress['reqPoint'] ?? 0) . ' poin lagi sebelum naik level!' }}" />
        </div>

        {{-- notifikasi --}}
        <div class="col-span-2">
            <a href="/notifikasi" title="Cek notifikasi">
                <x-bento-item>
                    <div class="flex items-center justify-between">
                        <div>
                            <div>Notifikasi</div>
                            <div class="font-semibold -mt-1">
                                {{ cekNotifikasi() ? 'Kamu punya notifikasi baru!' : 'Belum ada notifikasi baru.' }}
                            </div>
                        </div>
                        <div class="bg-amber-400 text-neutral-800 rounded-2xl py-3 px-3 relative">
                            <i data-lucide='bell'></i>
                            @if (cekNotifikasi())
                                <div class="absolute right-3 top-3 w-2.5 h-2.5 rounded-full bg-red-600"></div>
                            @endif
                        </div>
                    </div>
                </x-bento-item>
            </a>
        </div>
    </div>
</div>
