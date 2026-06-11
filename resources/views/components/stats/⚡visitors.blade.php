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
            $dataset[] = (int) $d->pengunjung;
            $label[] = Carbon::create()->month($d->bulan)->format('M');
        }

        // fallback jika data kosong
        if (empty($dataset)) {
            $dataset = [0];
            $label = ['-'];
        }

        // dd($this->data, $dataset);

        // inisiasi grafik
        $chart = LarapexChart::areaChart() //
            ->addData($dataset, 'Pengunjung')
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

{{-- ✅ script diletakkan di luar wire:ignore, push ke stack --}}
{{-- @push('scripts')
    <script src="{{ $chart->cdn() }}"></script>
    {!! $chart->script() !!}
@endpush --}}
