<?php

use Livewire\Component;
use App\Models\User;
use App\Models\Report;
use Livewire\Attributes\Computed;

new class extends Component {
    public $terlaporId;
    // data pelapor
    #[Computed]
    public function terlapor()
    {
        // statistik pelapor
        $terlapor = User::find($this->terlaporId);
        $terlapor->level = levelCalculator($terlapor->poin);

        //Jumlah dilaporkan pengguna lain
        $terlapor->totalLaporan = Report::whereHas('definisi', function ($query) {
            $query->where('user_id', $this->terlaporId);
        })->count();

        $kodeDefinisi = Report::whereHas('definisi', function ($query) {
            $query->where('user_id', $this->terlaporId);
        });
        $terlapor->laporanBersalahDilaporkan = (clone $kodeDefinisi)->count(); //Jumlah dinyatakan bersalah

        //Jumlah hukuman yang pernah diterima
        $terlapor->jmlLaporanBlnIni = (clone $kodeDefinisi)->whereNot('hukuman', 'peringatan')->count();

        return $terlapor;
    }
};
?>

{{-- data terlapor --}}
<x-bento-item title="Tentang terlapor" urlText="Lihat" url="/u/{{ $this->terlapor->username }}">
    <div class="space-y-2">
        <div class="flex items-center gap-2">
            <x-avatar :avatarUrl="$this->terlapor->profile_pic" />
            <div class="">
                <div class="font-semibold">{{ $this->terlapor->nama }}</div>
                <div class="text-neutral-600 text-sm">&#64;{{ $this->terlapor->username }}</div>
            </div>
        </div>
        <x-report-detail-item label="Level"
            value="{{ $this->terlapor->level . ' (' . $this->terlapor->poin . ' poin)' }}" />
        <x-report-detail-item label="Definisi terlapor dilaporkan"
            value="{{ $this->terlapor['totalLaporan'] }} definisi" />
        <x-report-detail-item label="Definisi terlapor terbukti bersalah"
            value="{{ $this->terlapor['laporanBersalahDilaporkan'] }} definisi" />
        <x-report-detail-item label="Definisi dilaporkan terlapor bulan ini"
            value="{{ $this->terlapor['jmlLaporanBlnIni'] }} definisi" />
        <x-report-detail-item label="Bergabung sejak" value="{{ dateFormat($this->terlapor->created_at) }}" />
    </div>
</x-bento-item>
