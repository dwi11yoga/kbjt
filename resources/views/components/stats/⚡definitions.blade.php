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
            $definisi_baru[] = (int) $d->definisi_baru;
            $definisi_diverifikasi[] = (int) $d->definisi_diverifikasi;
            $label[] = Carbon::create()->month($d->bulan)->format('M');
        }

        // inisiasi grafik
        $chart = LarapexChart::barChart() //
            ->addData($definisi_baru, 'Definisi baru')
            ->addData($definisi_diverifikasi, 'Definisi diverifikasi')
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
