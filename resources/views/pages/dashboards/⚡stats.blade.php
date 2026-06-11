<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use App\Models\Statistik;

new class extends Component {
    #[Title('Statistik')]
    #[Layout('layouts.dashboard')]
    #[Url]
    public $year;

    public function updatedYear()
    {
        return redirect('/statistik?year=' . $this->year);
    }

    public $yearOptions;
    public function mount()
    {
        // set tahun ke tahun ini
        $this->year = $this->year ?? now()->year;
        // dapatkan daftar tahun
        $this->yearOptions = Statistik::select('tahun')->distinct()->orderByDesc('tahun')->pluck('tahun');

        // jika tahun yang dipilih tidak tersedia pada database
        if (!in_array($this->year, $this->yearOptions->toArray())) {
            abort(404, 'Data tidak ditemukan');
        }
    }

    // dapatkan data statistik
    #[Computed]
    public function data()
    {
        $data = Statistik::select();

        if ($this->year == now()->year) {
            $data = $data->orderByDesc('tahun')->orderByDesc('bulan')->limit(12);
        } else {
            $data = $data->where('tahun', $this->year)->orderBy('tahun')->orderBy('bulan');
        }

        $data = $data->get();

        if ($this->year == now()->year) {
            $data = $data->reverse()->values();
        }

        return $data;
    }
};
?>

<div class="grid md:grid-cols-3 grid-cols-1 gap-2">
    {{-- periode --}}
    <div class="md:col-span-3 col-span-1 flex md:flex-row flex-col md:justify-between md:items-center gap-2 py-3">
        <div class="">Periode</div>
        <div class="flex items-center gap-1 overflow-x-auto">
            @foreach ($yearOptions as $option)
                <x-input-radio model="year" id="{{ $option }}" value="{{ $option }}"
                    text="{{ $option }}" />
            @endforeach
        </div>
    </div>

    {{-- statistik --}}
    {{-- pengunjung --}}
    <div class="md:col-span-3 col-span-1">
        <x-bento-item title="Pengunjung">
            <x-slot:rightTitle>
                <x-badge title="Total pengunjung">
                    {{ numberFormat($this->data->sum('pengunjung')) }}
                </x-badge>  
            </x-slot:rightTitle>
            <livewire:stats.visitors :data="$this->data" />
        </x-bento-item>
    </div>

    {{-- anggota --}}
    <div class="md:col-span-2 col-span-1">
        <x-bento-item title="Anggota">
            <x-slot:rightTitle>
                <div class="flex gap-1">
                    <x-badge title="Pengguna bertambah" gap="1">
                        <i data-lucide='user-round-plus' class="size-4"></i>
                        <div class="">{{ numberFormat($this->data->sum('user_baru')) }}</div>
                    </x-badge>
                    <x-badge title="Akun dihapus" gap="1">
                        <i data-lucide='user-round-x' class="size-4"></i>
                        <div class="">{{ numberFormat($this->data->sum('akun_dihapus')) }}</div>
                    </x-badge>
                </div>
            </x-slot:rightTitle>
            <livewire:stats.members :data="$this->data" />
        </x-bento-item>
    </div>

    {{-- artikel --}}
    <x-bento-item title="Artikel">
        <x-slot:rightTitle>
            <x-badge title="Aritkel diterbitkan">
                {{ numberFormat($this->data->sum('artikel_dipublikasikan')) }}
            </x-badge>
        </x-slot:rightTitle>
        <livewire:stats.articles :data="$this->data" />
    </x-bento-item>

    {{-- Definisi --}}
    <x-bento-item title="Definisi">
        <x-slot:rightTitle>
            <div class="flex gap-1">
                <x-badge title="Definisi baru" gap="1">
                    <i data-lucide='circle-plus' class="size-4"></i>
                    <div class="">{{ numberFormat($this->data->sum('definisi_baru')) }}</div>
                </x-badge>
                <x-badge title="Definisi diverifikasi" gap="1">
                    <i data-lucide='badge-check' class="size-4"></i>
                    <div class="">{{ numberFormat($this->data->sum('definisi_diverifikasi')) }}</div>
                </x-badge>
            </div>
        </x-slot:rightTitle>
        <livewire:stats.definitions :data="$this->data" />
    </x-bento-item>

    {{-- Laporan --}}
    <div class="md:col-span-2 col-span-1">
        <x-bento-item title="Laporan">
            <x-slot:rightTitle>
                <div class="flex gap-1">
                    <x-badge title="Laporan baru" gap="1">
                        <i data-lucide='circle-plus' class="size-4"></i>
                        <div class="">{{ numberFormat($this->data->sum('laporan_baru')) }}</div>
                    </x-badge>
                    <x-badge title="Laporan ditangani" gap="1">
                        <i data-lucide='scale' class="size-4"></i>
                        <div class="">{{ numberFormat($this->data->sum('laporan_ditangani')) }}</div>
                    </x-badge>
                    <x-badge title="Laporan bersalah" gap="1">
                        <i data-lucide='gavel' class="size-4"></i>
                        <div class="">{{ numberFormat($this->data->sum('laporan_bersalah')) }}</div>
                    </x-badge>
                </div>
            </x-slot:rightTitle>
            <livewire:stats.reports :data="$this->data" />
        </x-bento-item>
    </div>
</div>
