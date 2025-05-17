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
        $statistik = Statistik::where('tahun', $request->tahun ?? Carbon::now()->year)
            ->orderBy('bulan', 'asc')
            ->get();

        // dapatkan data tahun
        $tahun = Statistik::select('tahun')
            ->orderBy('tahun', 'desc')
            ->distinct('tahun') // jangan ambil data duplikat
            ->get()
            ->pluck('tahun') // ambil hanya data tahun
            ->toArray();

        // array bulan
        $bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan[$i] = Carbon::createFromFormat('m', $i)->translatedFormat('M'); // ubah bulan dalam nomor jadi nama bulan
        }

        // dapatkan nilai maksimum dari masing-masing kategori-> untuk menghitung tinggi maks diagram bar
        $nilaiMax = [
            'pengunjung' => $statistik->max('pengunjung'),
            'anggota' => max(
                $statistik->max('user_baru'),
                $statistik->max('akun_dihapus')
            ),
            'kosakata' => $statistik->max('kosakata_baru'),
            'editKosakata' => max(
                $statistik->max('kosakata_edit'),
                $statistik->max('kosakata_edit_disetujui')
            ),
            'definisi' => max(
                $statistik->max('definisi_baru'),
                $statistik->max('definisi_diverifikasi')
            ),
            'artikel' => $statistik->max('artikel_dipublikasikan'),
            'laporan' => max(
                $statistik->max('laporan_baru'),
                $statistik->max('laporan_ditangani'),
                $statistik->max('laporan_bersalah')
            )
        ];


        // kategorikan statistik dalam bulan dalam bentuk array
        // kategorikan pengunjung
        if ($statistik->isEmpty()) {
            $pengunjung = [];
        } else {
            foreach ($statistik as $d) {
                // hitung persentase -> untuk panjang bar (jika nilai max 0, ganti dengan 1 agar tidak error saat pembagian)
                $persentase = round(($d->pengunjung / ($nilaiMax['pengunjung'] > 0 ? $nilaiMax['pengunjung'] : 1)) * 100);
                $pengunjung[$d->bulan] = [
                    // 'bulan' => Carbon::createFromFormat('m', $d->bulan)->translatedFormat('M'), // ubah bulan dalam nomor jadi nama bulan
                    'jumlah' => number_format($d->pengunjung, 0, ',', '.'),
                    // 'persentase' => $this->persentase($d->pengunjung, $nilaiMax['pengunjung']),
                    'persentase' => $persentase > 5 ? $persentase . '%' : '5%',
                ];
            }
        }

        // kategorikan anggota
        if ($statistik->isEmpty()) {
            $anggota = [];
        } else {
            foreach ($statistik as $d) {
                // hitung persentase -> untuk panjang bar (jika nilai max 0, ganti dengan 1 agar tidak error saat pembagian)
                $persentaseAnggotaBaru = round(($d->user_baru / ($nilaiMax['anggota'] > 0 ? $nilaiMax['anggota'] : 1)) * 100);
                $persentaseAnggotaHapusAkun = round(($d->akun_dihapus / ($nilaiMax['anggota'] > 0 ? $nilaiMax['anggota'] : 1)) * 100);
                $anggota[$d->bulan] = [
                    // Anggota baru
                    'jumlahAnggotaBaru' => number_format($d->user_baru, 0, ',', '.'),
                    'persentaseAnggotaBaru' => $persentaseAnggotaBaru > 5 ? $persentaseAnggotaBaru . '%' : '5%',
                    // user yang menhapus akunnya
                    'jumlahAnggotaHapusAkun' => number_format($d->akun_dihapus, 0, ',', '.'),
                    'persentaseAnggotaHapusAkun' => $persentaseAnggotaHapusAkun > 5 ? $persentaseAnggotaHapusAkun . '%' : '5%',
                ];
            }
        }

        // kategorikan kosakata
        if ($statistik->isEmpty()) {
            $kosakata = [];
        } else {
            foreach ($statistik as $d) {
                // hitung persentase -> untuk panjang bar (jika nilai max 0, ganti dengan 1 agar tidak error saat pembagian)
                $persentase = round(($d->kosakata_baru / ($nilaiMax['kosakata'] > 0 ? $nilaiMax['kosakata'] : 1)) * 100);
                $kosakata[$d->bulan] = [
                    // Kosakata baru
                    'jumlah' => number_format($d->kosakata_baru, 0, ',', '.'),
                    'persentase' => $persentase > 5 ? $persentase . '%' : '5%',
                ];
            }
        }

        // kategorikan Edit Kosakata
        if ($statistik->isEmpty()) {
            $editKosakata = [];
        } else {
            foreach ($statistik as $d) {
                // hitung persentase -> untuk panjang bar (jika nilai max 0, ganti dengan 1 agar tidak error saat pembagian)
                $persentaseKosakataEdit = round(($d->kosakata_edit / ($nilaiMax['editKosakata'] > 0 ? $nilaiMax['editKosakata'] : 1)) * 100);
                $persentaseKosakataEditDisetujui = round(($d->kosakata_edit_disetujui / ($nilaiMax['editKosakata'] > 0 ? $nilaiMax['editKosakata'] : 1)) * 100);
                $editKosakata[$d->bulan] = [
                    // edit kosakata 
                    'jumlahKosakataEdit' => number_format($d->kosakata_edit, 0, ',', '.'),
                    'persentaseKosakataEdit' => $persentaseKosakataEdit > 5 ? $persentaseKosakataEdit . '%' : '5%',
                    // edit kosakata diverifikasi
                    'jumlahKosakataEditDisetujui' => number_format($d->kosakata_edit_disetujui, 0, ',', '.'),
                    'persentaseKosakataEditDisetujui' => $persentaseKosakataEditDisetujui > 5 ? $persentaseKosakataEditDisetujui . '%' : '5%',
                ];
            }
        }

        // kategorikan Definisi
        if ($statistik->isEmpty()) {
            $definisi = [];
        } else {
            foreach ($statistik as $d) {
                // hitung persentase -> untuk panjang bar (jika nilai max 0, ganti dengan 1 agar tidak error saat pembagian)
                $persentaseDefinisi = round(($d->definisi_baru / ($nilaiMax['definisi'] > 0 ? $nilaiMax['definisi'] : 1)) * 100);
                $persentaseDefinisiDiverifikasi = round(($d->definisi_diverifikasi / ($nilaiMax['definisi'] > 0 ? $nilaiMax['definisi'] : 1)) * 100);
                $definisi[$d->bulan] = [
                    // definisi baru
                    'jumlahDefinisi' => number_format($d->definisi_baru, 0, ',', '.'),
                    'persentaseDefinisi' => $persentaseDefinisi > 5 ? $persentaseDefinisi . '%' : '5%',
                    // definisi diverifikasi
                    'jumlahDefinisiDiverifikasi' => number_format($d->definisi_diverifikasi, 0, ',', '.'),
                    'persentaseDefinisiDiverifikasi' => $persentaseDefinisiDiverifikasi > 5 ? $persentaseDefinisiDiverifikasi . '%' : '5%',
                ];
            }
        }

        // kategorikan artikel
        if ($statistik->isEmpty()) {
            $artikel = [];
        } else {
            foreach ($statistik as $d) {
                // hitung persentase -> untuk panjang bar (jika nilai max 0, ganti dengan 1 agar tidak error saat pembagian)
                $persentase = round(($d->artikel_dipublikasikan / ($nilaiMax['artikel'] > 0 ? $nilaiMax['artikel'] : 1)) * 100);
                $artikel[$d->bulan] = [
                    'jumlah' => number_format($d->artikel_dipublikasikan, 0, ',', '.'),
                    'persentase' => $persentase > 5 ? $persentase . '%' : '5%',
                ];
            }
        }

        // kategorikan laporan
        if ($statistik->isEmpty()) {
            $laporan = [];
        } else {
            foreach ($statistik as $d) {
                // hitung persentase -> untuk panjang bar (jika nilai max 0, ganti dengan 1 agar tidak error saat pembagian)
                $persentaseLaporan = round(($d->laporan_baru / ($nilaiMax['laporan'] > 0 ? $nilaiMax['laporan'] : 1)) * 100);
                $persentaseLaporanDitangani = round(($d->laporan_ditangani / ($nilaiMax['laporan'] > 0 ? $nilaiMax['laporan'] : 1)) * 100);
                $persentaseLaporanBersalah = round(($d->laporan_bersalah / ($nilaiMax['laporan'] > 0 ? $nilaiMax['laporan'] : 1)) * 100);
                $laporan[$d->bulan] = [
                    // laporan baru
                    'jumlahLaporan' => number_format($d->laporan_baru, 0, ',', '.'),
                    'persentaseLaporan' => $persentaseLaporan > 5 ? $persentaseLaporan . '%' : '5%',
                    // laporan ditangani
                    'jumlahLaporanDitangani' => number_format($d->laporan_ditangani, 0, ',', '.'),
                    'persentaseLaporanDitangani' => $persentaseLaporanDitangani > 5 ? $persentaseLaporanDitangani . '%' : '5%',
                    // laporan bersalah
                    'jumlahLaporanBersalah' => number_format($d->laporan_bersalah, 0, ',', '.'),
                    'persentaseLaporanBersalah' => $persentaseLaporanBersalah > 5 ? $persentaseLaporanBersalah . '%' : '5%',
                ];
            }
        }

        // digunakan untuk menandai bulan dan tahun ini
        if (($request->tahun ?? Carbon::now()->year) == Carbon::now()->year) {
            $bulanSekarang = Carbon::now()->month;
        } else {
            $bulanSekarang = null;
        }

        // dd($bulanSekarang, $bulan);

        // view
        return view('dashboard.statistik', [
            'title' => 'Statistik',
            'group' => 'statistik',
            'tahun' => $tahun,
            'bulan' => $bulan,
            'nilaiMax' => $nilaiMax,
            'pengunjung' => $pengunjung,
            'anggota' => $anggota,
            'kosakata' => $kosakata,
            'editKosakata' => $editKosakata,
            'definisi' => $definisi,
            'artikel' => $artikel,
            'laporan' => $laporan,
            'bulanSekarang' => $bulanSekarang
        ]);
    }
}
