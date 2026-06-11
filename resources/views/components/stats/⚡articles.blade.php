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
        // ✅ jika data belum tersedia, return kosong dulu
        if (blank($this->data)) {
            return ['chart' => null];
        }

        foreach ($this->data as $d) {
            $dataset[] = (int) $d->artikel_dipublikasikan;
            $label[] = Carbon::create()->month($d->bulan)->format('M');
        }

        // fallback jika data kosong
        if (empty($dataset)) {
            $dataset = [0];
            $label = ['-'];
        }

        // dd($this->data, $dataset);

        // inisiasi grafik
        $chart = LarapexChart::horizontalBarChart() //
            ->addData($dataset, 'Artikel')
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