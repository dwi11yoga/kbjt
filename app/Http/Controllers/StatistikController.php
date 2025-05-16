<?php

namespace App\Http\Controllers;

use App\Models\Statistik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class StatistikController extends Controller
{
    //
    public function index(Request $request)
    {

        // dapatkan data statistik
        $statistik = Statistik::where('tahun', Carbon::now()->year)
            ->orderBy('bulan', 'asc')
            ->get();

        // dd($statistik);

        $nilaiMax=[
            'pengunjung'=>$statistik->max('pengunjung'),
        ];

        // array bulan
        $bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan[$i] = Carbon::createFromFormat('m', $i)->translatedFormat('M'); // ubah bulan dalam nomor jadi nama bulan
        }

        foreach ($statistik as $d) {
            $pengunjung[$d->bulan] = [
                // 'bulan' => Carbon::createFromFormat('m', $d->bulan)->translatedFormat('M'), // ubah bulan dalam nomor jadi nama bulan
                'jumlah' => number_format($d->pengunjung, 0, ',', '.'),
                'persentase' => $this->persentase($d->pengunjung, $nilaiMax['pengunjung']),
            ];
        }

        // view
        return view('dashboard.statistik', [
            'title' => 'Statistik',
            'group' => 'statistik',
            'bulan' => $bulan,
            'nilaiMax'=>$nilaiMax,
            'pengunjung' => $pengunjung
        ]);
    }
}
