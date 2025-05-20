<?php

namespace Database\Seeders;

use App\Models\Statistik;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 8; $i <= 12; $i++) {
            $tahunLalu[$i] = [
                'tahun' => 2024,
                'bulan' => $i,
                'pengunjung' => random_int(100, 1000),
                'user_baru' => random_int(0, 30),
                'akun_dihapus' => random_int(0, 5),
                'kosakata_baru' => random_int(0, 50),
                'kosakata_edit' => random_int(0, 20),
                'kosakata_edit_disetujui' => random_int(0, 19),
                'definisi_baru' => random_int(0, 200),
                'definisi_diverifikasi' => random_int(0, 50),
                'artikel_dipublikasikan' => random_int(0, 10),
                'laporan_baru' => random_int(0, 20),
                'laporan_ditangani' => random_int(0, 20),
                'laporan_bersalah' => random_int(0, 20),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        for ($i = 1; $i <= Carbon::now()->month; $i++) {
            $tahunIni[$i] = [
                'tahun' => 2025,
                'bulan' => $i,
                'pengunjung' => random_int(100, 1000),
                'user_baru' => random_int(0, 30),
                'akun_dihapus' => random_int(0, 5),
                'kosakata_baru' => random_int(0, 50),
                'kosakata_edit' => random_int(0, 20),
                'kosakata_edit_disetujui' => random_int(0, 19),
                'definisi_baru' => random_int(0, 200),
                'definisi_diverifikasi' => random_int(0, 50),
                'artikel_dipublikasikan' => random_int(0, 10),
                'laporan_baru' => random_int(0, 20),
                'laporan_ditangani' => random_int(0, 20),
                'laporan_bersalah' => random_int(0, 20),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $statistik=array_merge($tahunLalu, $tahunIni);
        // buat seeder
        Statistik::insert($statistik);
    }
}
