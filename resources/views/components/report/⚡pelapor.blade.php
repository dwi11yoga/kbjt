<?php

use Livewire\Component;
use App\Models\User;
use App\Models\Report;
use Livewire\Attributes\Computed;

new class extends Component {
    public $pelaporId;
    // data pelapor
    #[Computed]
    public function pelapor()
    {
        // statistik pelapor

        $pelapor = User::find($this->pelaporId);
        $pelapor->level = levelCalculator($pelapor->poin);

        //Definisi & Kosakata dilaporkan pelapor
        $pelapor->totalLaporan = Report::where('user_id', $this->pelaporId)->count();
        //Definisi & Kosakata terbukti bersalah yang dilaporkan pelapor
        $pelapor->laporanBersalahDilaporkan = Report::where('user_id', $this->pelaporId)->whereNotNull('hukuman')->count();
        //Definisi & Kosakata dilaporkan bulan ini
        $pelapor->jmlLaporanBlnIni = Report::where('user_id', $this->pelaporId) //
            ->whereMonth('created_at', now()->month)
            ->count();

        return $pelapor;
    }
};
?>

{{-- data pelapor --}}
<x-bento-item title="Tentang pelapor" urlText="Lihat" url="/u/{{ $this->pelapor->username }}">
    <div class="space-y-2">
        <div class="flex items-center gap-2">
            <x-avatar :avatarUrl="$this->pelapor->profile_pic" />
            <div class="">
                <div class="font-semibold">{{ $this->pelapor->nama }}</div>
                <div class="text-neutral-600 text-sm">&#64;{{ $this->pelapor->username }}</div>
            </div>
        </div>
        <x-report-detail-item label="Level"
            value="{{ $this->pelapor->level . ' (' . $this->pelapor->poin . ' poin)' }}" />
        <x-report-detail-item label="Definisi dilaporkan" value="{{ $this->pelapor['totalLaporan'] }} definisi" />
        <x-report-detail-item label="Laporan terbukti bersalah"
            value="{{ $this->pelapor['laporanBersalahDilaporkan'] }} definisi" />
        <x-report-detail-item label="Definisi dilaporkan pelapor bulan ini"
            value="{{ $this->pelapor['jmlLaporanBlnIni'] }} definisi" />
        <x-report-detail-item label="Bergabung sejak" value="{{ dateFormat($this->pelapor->created_at) }}" />
    </div class="space-y-2">
</x-bento-item>
