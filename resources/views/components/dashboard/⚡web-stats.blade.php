<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\User;
use App\Models\Definisi;
use App\Models\Blog;
use App\Models\Report;
use App\Models\Statistik;

new class extends Component {
    //

    // stats khusus untuk pengurus dan kepala
    #[Computed]
    public function webStats()
    {
        // total anggota
        $statistik['anggota'] = number_format(User::count('id'), 0, ',', '.');

        // anggota baru bulan ini
        $statistik['anggotaBlnIni'] = User::whereYear('created_at', now()->year) //
            ->whereMonth('created_at', now()->month)
            ->count('id');
        $statistik['anggotaBlnIni'] = number_format($statistik['anggotaBlnIni'], 0, ',', '.');

        // statistik definisi
        $statistik['definisi'] = number_format(Definisi::count('id'), 0, ',', '.');
        $statistik['definisiBlnIni'] = Definisi::whereYear('created_at', now()->year) //
            ->whereMonth('created_at', now()->month)
            ->count('id');
        $statistik['definisiBlnIni'] = number_format($statistik['definisiBlnIni'], 0, ',', '.');

        // statistik aritkel
        $statistik['post'] = Blog::count('id');
        $statistik['postPublish'] = Blog::whereNotNull('status')->count('id');

        // statistik laporan
        $statistik['laporanBlmDitangani'] = Report::whereNull('pengurus_id')->count();
        $statistik['laporanBlnIni'] = Report::whereYear('created_at', now()->year) //
            ->whereMonth('created_at', now()->month)
            ->count();

        // definisi terverifikasi
        $statistik['defTerverify'] = Definisi::where('verifikasi', '=', '1')->count('id');

        // dapatkan data pengunjung bulanan (jika user!=kontributor)
        // bulan ini
        $statistik['pengunjung']['blnIni'] =
            Statistik::whereYear('tahun', now()->year) //
                ->whereMonth('bulan', now()->month)
                ->first()->pengunjung ?? 0;
        // bulan kemarin
        $tahun = now()->month == 1 ? now()->subYear()->year : now()->year;
        $statistik['pengunjung']['blnKemarin'] =
            Statistik::whereYear('tahun', $tahun)
                ->whereMonth('bulan', now()->subMonth()->month)
                ->first()->pengunjung ?? 0;

        return $statistik;
    }
};
?>

<div class="space-y-2">
    <div class="">Performa web</div>
    <div class="grid md:grid-cols-3 grid-cols-1 gap-2 ">

        {{-- Pengunjung --}}
        <x-bento-item title="Pengunjung bulan ini" urlText="Statistik" url="/statistik"
            value="{{ number_format($this->webStats['pengunjung']['blnIni'], 0, ',', '.') }}"
            footnote="Bulan sebelumnya {{ number_format($this->webStats['pengunjung']['blnKemarin'], 0, ',', '.') }}
                        pengunjung" />

        {{-- Anggota --}}
        <x-bento-item title="Anggota" url="/kontributor" urlText="Detail" value="{{ $this->webStats['anggota'] }}"
            footnote="Bulan ini bertambah {{ $this->webStats['anggotaBlnIni'] }} anggota" />

        {{-- definisi --}}
        <x-bento-item title="Definisi" url="/kontributor#definisi" urlText="Detail"
            value="{{ $this->webStats['definisi'] }}"
            footnote="Bulan ini bertambah {{ $this->webStats['definisiBlnIni'] }} definisi" />

        {{-- Post --}}
        <x-bento-item title="Artikel" url="/artikel" urlText="Detail" value="{{ $this->webStats['post'] }}"
            footnote="Total {{ $this->webStats['postPublish'] }} artikel dipublikasikan" />

        {{-- Laporan --}}
        <x-bento-item title="Laporan belum ditangani" url="/laporan" urlText="Detail"
            value="{{ $this->webStats['laporanBlmDitangani'] }}"
            footnote="Bulan ini ada {{ $this->webStats['laporanBlnIni'] }} laporan baru" />
    </div>
</div>
