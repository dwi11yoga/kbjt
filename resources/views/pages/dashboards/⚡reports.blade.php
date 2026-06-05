<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use App\Models\Report;
use App\Models\User;
use App\Models\Definisi;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    #[Title('Laporan')]
    #[Layout('layouts.dashboard')]
    #[Computed]
    public function overview()
    {
        $statistik = new stdClass();
        $statistik->laporanTotal = Report::count();
        $statistik->laporanBlnIni = Report::whereYear('created_at', now()->year) //
            ->whereMonth('created_at', now()->month)
            ->count();
        $statistik->pending = Report::whereNull('status')->count();
        $statistik->selesai = Report::whereNotNull('status')->count();
        $statistik->ditanganiUser = Report::where('pengurus_id', auth()->user()->id)->count();
        $statistik->ditanganiBlnIni = Report::where('pengurus_id', auth()->user()->id)
            ->whereYear('created_at', now()->year)
            ->whereMonth('status', now()->month)
            ->count();
        return $statistik;
    }

    // daftar definisi dilaporkan
    #[Url]
    public $filter = 'semua';
    #[Computed]
    public function reportedDefinitions()
    {
        // Laporan (definisi)
        $laporan = Report::select('*');

        // filter definisi
        if ($this->filter == 'pending') {
            $laporan = $laporan->whereNull('status');
        } elseif ($this->filter == 'selesai') {
            $laporan = $laporan->whereNotNull('status');
        } elseif ($this->filter == 'kamu-tangani') {
            $laporan = $laporan->where('pengurus_id', auth()->user()->id);
        }

        $laporan = $laporan->orderBy('updated_at', 'desc')->paginate(20);

        foreach ($laporan as $d) {
            // dibuat seperti ini agar tidak error ketika ada user/definisi yang dihapus
            $d->user = User::withTrashed()
                ->select('id', 'username', 'nama', 'role', 'jenis_kelamin', 'profile_pic') //
                ->where('id', $d->user_id)
                ->first();
            $d->definisi = Definisi::withTrashed()
                ->select('id', 'kosakata', 'user_id', 'definisi', 'updated_at') //
                ->where('id', $d->definisi_id)
                ->first();
            $d->pengurus = User::withTrashed()
                ->select('id', 'nama', 'username', 'role', 'profile_pic', 'jenis_kelamin', 'deleted_at') //
                ->where('id', $d->pengurus_id)
                ->first();

            // cek apakah data user (pengurus) ada/terhapus
            if ($d->pengurus && $d->pengurus->trashed()) {
                $d->pengurus->statusUser = 'dihapus';
            }

            // dapatkan terlapor
            $d->terlapor = User::where('id', $d->definisi->user_id)->value('nama');
        }

        return $laporan;
    }
};
?>

<div class="space-y-5">
    {{-- Overview --}}
    <div class="space-y-2">
        <div class="">Overview</div>
        <div class="grid md:grid-cols-3 grid-cols-2 gap-2">
            {{-- total laporan --}}
            <x-bento-item title="Total laporan" value="{{ numberFormat($this->overview->laporanTotal) }}"
                footnote="Bulan ini bertambah {{ numberFormat($this->overview->laporanBlnIni) }} laporan" />

            {{-- laporan belum ditangani --}}
            <x-bento-item title="Laporan belum ditangani" value="{{ numberFormat($this->overview->pending) }}"
                footnote="Total {{ numberFormat($this->overview->selesai) }} laporan selesai ditangani" />

            {{-- Laporan yang kamu tangani --}}
            @if (auth()->user()->role == 'pengurus')
                <x-bento-item title="Laporan yang anda tangani"
                    value="{{ numberFormat($this->overview->ditanganiUser) }}"
                    footnote="Bulan ini kamu menangani {{ numberFormat($this->overview->ditanganiBlnIni) }}
                        laporan" />
            @endif
        </div>
    </div>

    {{-- laporan definisi --}}
    <div class="bg-white">
        {{-- atas/title --}}
        <div class="py-2 flex gap-2 md:flex-row flex-col justify-between md:items-center">
            <div class="text-nowrap">Definisi Dilaporkan</div>

            {{-- filter --}}
            <x-radio-group overflow="overflow-x-auto">
                <x-input-radio model="filter" id="semua" value="semua" text="Semua" icon="layout-grid" />
                <x-input-radio model="filter" id="pending" value="pending" text="Pending" icon="clock" />
                <x-input-radio model="filter" id="selesai" value="selesai" text="Selesai" icon="circle-check" />
                <x-input-radio model="filter" id="kamu-tangani" value="kamu-tangani" text="Kamu tangani"
                    icon="user-round" />
            </x-radio-group>
            {{-- <div class="relative">
                <i data-lucide='filter' class="w-5 absolute top-2 left-3"></i>
                <select wire:model.live='filter' name="filter" id="filter"
                    class="appearance-none border md:text-base text-sm border-neutral-200 rounded-xl py-2 pl-10 pr-3 bg-white cursor-pointer">
                    <option value="semua">Semua</option>
                    <option value="pending">Belum ditangani</option>
                    <option value="selesai">Selesai ditangani</option>
                    @if (auth()->user()->role == 'pengurus')
                        <option value="kamu-tangani">Kamu tangani</option>
                    @endif
                </select>
            </div> --}}
        </div>

        <div class="space-y-2">
            {{-- daftar definisi dilaporkan --}}
            @foreach ($this->reportedDefinitions as $d)
                <x-list-item type="url" url="/laporan/{{ $d->id }}">
                    <x-slot:leftText>
                        {{-- title --}}
                        <div class="">
                            {{ $d->user->nama }} melaporkan definisi {{ $d->definisi->kosakata }} milik
                            {{ $d->terlapor }}
                        </div>
                    </x-slot:leftText>
                    <x-slot:rightText>
                        {{-- status --}}
                        <x-badge gap="1" color="{{ isset($d->status) ? 'bg-green-100' : 'bg-red-100' }}"
                            hoverColor="{{ isset($d->status) ? 'hover:bg-green-300' : 'hover:bg-red-300' }}">
                            <i data-lucide='{{ isset($d->status) ? 'check-circle' : 'circle-alert' }}'
                                class="w-4"></i>
                            <span>{{ isset($d->status) ? 'Selesai' : 'Pending' }}</span>
                        </x-badge>
                        <x-badge>
                            {{ dateFormat($d->updated_at) }}
                        </x-badge>
                    </x-slot:rightText>
                </x-list-item>
            @endforeach
            {{-- jika data kosong --}}
            @if ($this->reportedDefinitions->isEmpty())
                <x-errors.not-found text="Belum ada data" />
            @endif
            {{-- paginate --}}
            {{ $this->reportedDefinitions->links() }}
        </div>

    </div>
</div>
