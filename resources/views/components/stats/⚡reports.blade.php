<?php

use Livewire\Component;
use App\Models\Statistik;
use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

new class extends Component {
    //dapatkan data dari parent
    public $data;

    // buat chart
    public function with()
    {
        foreach ($this->data as $d) {
            $laporan_baru[] = (int) $d->laporan_baru;
            $laporan_ditangani[] = (int) $d->laporan_ditangani;
            $laporan_bersalah[] = (int) $d->laporan_bersalah;
            $label[] = Carbon::create()->month($d->bulan)->format('M');
        }

        // inisiasi grafik
        $chart = LarapexChart::areaChart() //
            ->addData($laporan_baru, 'Laporan baru')
            ->addData($laporan_ditangani, 'Laporan ditangani')
            ->addData($laporan_bersalah, 'Laporan bersalah')
            ->setHeight(250)
            ->setXAxis($label)
            ->setGrid();

        return [
            'chart' => $chart,
        ];
    }
};
?>

{{-- grafik --}}
<div wire:ignore class="h-fit -m-3">
    @if ($chart)
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    @endif
</div>
