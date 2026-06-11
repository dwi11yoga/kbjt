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
            $user_baru[] = (int) $d->user_baru;
            $user_dihapus[] = (int) $d->akun_dihapus;
            $label[] = Carbon::create()->month($d->bulan)->format('M');
        }

        // fallback jika data kosong
        // if (empty($dataset)) {
        //     $dataset = [0];
        //     $label = ['-'];
        // }

        // dd($label);
        // dd($this->data, $dataset);

        // inisiasi grafik
        $chart = LarapexChart::barChart() //
            ->addData($user_baru, 'Pengguna baru')
            ->addData($user_dihapus, 'Akun dihapus')
            ->setHeight(250)
            ->setXAxis($label)
            ->setColors(['#ffba00', '#ff455f'])
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
