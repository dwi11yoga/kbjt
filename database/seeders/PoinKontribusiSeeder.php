<?php

namespace Database\Seeders;

use App\Models\PoinKontribusi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoinKontribusiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PoinKontribusi::insert([
            
            // KONTRIBUTOR
            // kosakata
            [
                // Tambah kosakata
                'role' => 'kontributor',
                'kontribusi' => 'Tambah kosakata',
                'deskripsi' => 'Poin diberikan saat kontributor menambahkan kosakata baru',
                'poin' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Edit kosakata
                'role' => 'kontributor',
                'kontribusi' => 'Edit kosakata',
                'deskripsi' => 'Poin diberikan saat form permohonan edit kosakata kontributor disetujui pengurus',
                'poin' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Buat permintaan hapus kosakata
                'role' => 'kontributor',
                'kontribusi' => 'Buat permintaan hapus kosakata',
                'deskripsi' => 'Poin diberikan saat form permohonan hapus kosakata kontributor disetujui pengurus',
                'poin' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // definisi
            [
                // tambah definisi
                'role' => 'kontributor',
                'kontribusi' => 'Tambah definisi',
                'deskripsi' => 'Poin diberikan saat kontributor menambahkan definisi baru untuk sebuah kosakata',
                'poin' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Definisi terverifikasi
                'role' => 'kontributor',
                'kontribusi' => 'Definisi terverifikasi',
                'deskripsi' => 'Kontributor memperoleh poin setelah definisi yang disubmitnya diverifikasi oleh pengurus',
                'poin' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Laporkan definisi
                'role' => 'kontributor',
                'kontribusi' => 'Laporkan definisi',
                'deskripsi' => 'Poin diberikan jika laporan kontributor tentang definisi yang melanggar ketentuan disetujui',
                'poin' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],


            // PENGURUS
            // kosakata
            [
                // Tambah kosakata
                'role' => 'pengurus',
                'kontribusi' => 'Tambah kosakata',
                'deskripsi' => 'Poin diberikan saat pengurus menambahkan kosakata baru',
                'poin' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Edit kosakata
                'role' => 'pengurus',
                'kontribusi' => 'Edit kosakata',
                'deskripsi' => 'Pengurus mendapatkan poin atas perubahan/edit langsung pada kosakata',
                'poin' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Buat permintaan hapus kosakata
                'role' => 'pengurus',
                'kontribusi' => 'Buat permintaan hapus kosakata',
                'deskripsi' => 'Poin diberikan pada pengurus setelah form permintaan hapus kosakata disetujui',
                'poin' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Setujui form edit kosakata dari pengurus
                'role' => 'pengurus',
                'kontribusi' => 'Setujui form edit kosakata dari kontributor',
                'deskripsi' => 'Poin diberikan kepada pengurus yang menyetujui perubahan detail kosakata dari kontributor',
                'poin' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // definisi
            [
                // tambah definisi
                'role' => 'pengurus',
                'kontribusi' => 'Tambah definisi',
                'deskripsi' => 'Poin diberikan saat pengurus menambahkan definisi baru untuk sebuah kosakata',
                'poin' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Verifikasi definisi
                'role' => 'pengurus',
                'kontribusi' => 'Verifikasi definisi',
                'deskripsi' => 'Poin diberikan kepada pengurus setelah memverifikasi definisi',
                'poin' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Laporkan definisi
                'role' => 'pengurus',
                'kontribusi' => 'Laporkan definisi',
                'deskripsi' => 'Poin diberikan kepada pengurus jika laporannya disetujui',
                'poin' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // BLOG
            [
                // Publikasikan artikel
                'role' => 'pengurus',
                'kontribusi' => 'Publikasikan artikel',
                'deskripsi' => 'Pengurus memperoleh poin setelah artikel berhasil dipublikasikan',
                'poin' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // LAPORAN
            [
                // Tindaklanjuti laporan
                'role' => 'pengurus',
                'kontribusi' => 'Tindaklanjuti laporan',
                'deskripsi' => 'Poin diberikan kepada pengurus yang menindaklanjuti laporan, baik hasilnya bersalah maupun tidak',
                'poin' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
