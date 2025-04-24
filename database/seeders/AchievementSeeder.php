<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Achievement::insert([
            // keanggotaan
            [
                'role' => null,
                'nama' => 'Nini Among',
                'deskripsi' => 'Mendaftar sebagai anggota KBJT.',
                'rule' => 'keanggotaan',
                'requirement' => 0, //hari
                'reward' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Panembah Kawruh',
                'deskripsi' => 'Menjadi anggota KBJT selama 3 bulan.',
                'rule' => 'keanggotaan',
                'requirement' => 90, //hari
                'reward' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Jangka Mandhita',
                'deskripsi' => 'Menjadi anggota KBJT selama 6 bulan.',
                'rule' => 'keanggotaan',
                'requirement' => 182, //hari
                'reward' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Kawruh Langgeng',
                'deskripsi' => 'Menjadi anggota KBJT selama 1 tahun.',
                'rule' => 'keanggotaan',
                'requirement' => 365, //hari
                'reward' => 400,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Panenger Wibawa',
                'deskripsi' => 'Menjadi anggota KBJT selama 2 tahun.',
                'rule' => 'keanggotaan',
                'requirement' => 730, //hari
                'reward' => 800,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Sang Pamedhar Sabda',
                'deskripsi' => 'Menjadi anggota KBJT selama 5 tahun.',
                'rule' => 'keanggotaan',
                'requirement' => 1825, //hari
                'reward' => 2000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Wiku Wasesa',
                'deskripsi' => 'Menjadi anggota KBJT selama 10 tahun.',
                'rule' => 'keanggotaan',
                'requirement' => 3650, //hari
                'reward' => 5000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Definisi
            [
                'role' => null,
                'nama' => 'Pamanggon Kawruh',
                'deskripsi' => 'Submit 1 buah definisi baru.',
                'rule' => 'definisi',
                'requirement' => 1, //jumlah definisi
                'reward' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Pangandika Kawigaten',
                'deskripsi' => 'Submit 20 buah definisi baru.',
                'rule' => 'definisi',
                'requirement' => 20, //jumlah definisi
                'reward' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Panjaluk Pangerten',
                'deskripsi' => 'Submit 50 buah definisi baru',
                'rule' => 'definisi',
                'requirement' => 50, //jumlah definisi
                'reward' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Dhangan Pangawikan',
                'deskripsi' => 'Submit 100 buah definisi baru',
                'rule' => 'definisi',
                'requirement' => 100, //jumlah definisi
                'reward' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Tambah Kosakata
            [
                'role' => null,
                'nama' => 'Pangripta Basa',
                'deskripsi' => 'Submit 1 buah kosakata baru.',
                'rule' => 'kosakata',
                'requirement' => 1, //kosakata
                'reward' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Pamomongan Basa',
                'deskripsi' => 'Submit 20 buah kosakata baru.',
                'rule' => 'kosakata',
                'requirement' => 20, //kosakata
                'reward' => 150,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Sang Paramarta',
                'deskripsi' => 'Submit 50 buah kosakata baru.',
                'rule' => 'kosakata',
                'requirement' => 50, //kosakata
                'reward' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Sastra Pradipta',
                'deskripsi' => 'Submit 100 buah kosakata baru.',
                'rule' => 'kosakata',
                'requirement' => 100, //kosakata
                'reward' => 700,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Edit kosakata
            [
                'role' => null,
                'nama' => 'Tukang Rembesing Sabda',
                'deskripsi' => 'Perbaiki 1 detail kosakata yang tidak benar atau kurang lengkap.',
                'rule' => 'editKosakata',
                'requirement' => 1, //kosakata
                'reward' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Panglimbang Titi',
                'deskripsi' => 'Perbaiki 20 detail kosakata yang tidak benar atau kurang lengkap.',
                'rule' => 'editKosakata',
                'requirement' => 20, //kosakata
                'reward' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Catur Wicaksana',
                'deskripsi' => 'Perbaiki 50 detail kosakata yang tidak benar atau kurang lengkap.',
                'rule' => 'editKosakata',
                'requirement' => 50, //kosakata
                'reward' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Panatagama Basa',
                'deskripsi' => 'Perbaiki 100 detail kosakata yang tidak benar atau kurang lengkap.',
                'rule' => 'editKosakata',
                'requirement' => 100, //kosakata
                'reward' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Laporan
            [
                'role' => null,
                'nama' => 'Juru Jaga',
                'deskripsi' => 'Laporkan 1 definisi atau kosakata yang bermasalah.',
                'rule' => 'laporan',
                'requirement' => 1, //laporan
                'reward' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Pratanda Wicaksana',
                'deskripsi' => 'Laporkan 20 definisi atau kosakata yang bermasalah.',
                'rule' => 'laporan',
                'requirement' => 20, //laporan
                'reward' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Dewan Sastra',
                'deskripsi' => 'Laporkan 50 definisi atau kosakata yang bermasalah.',
                'rule' => 'laporan',
                'requirement' => 50, //laporan
                'reward' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Pangreksa Basa',
                'deskripsi' => 'Laporkan 100 definisi atau kosakata yang bermasalah.',
                'rule' => 'laporan',
                'requirement' => 100, //laporan
                'reward' => 700,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // blog
            [
                'role' => 'pengurus',
                'nama' => 'Panyerat Wiwara',
                'deskripsi' => 'Tulis dan publikasikan 1 artikel',
                'rule' => 'artikel',
                'requirement' => 1, //artikel
                'reward' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => 'pengurus',
                'nama' => 'Sang Pamarta',
                'deskripsi' => 'Tulis dan publikasikan 20 artikel',
                'rule' => 'artikel',
                'requirement' => 20, //artikel
                'reward' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => 'pengurus',
                'nama' => 'Wicaksana Wacana',
                'deskripsi' => 'Tulis dan publikasikan 50 artikel',
                'rule' => 'artikel',
                'requirement' => 50, //artikel
                'reward' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => 'pengurus',
                'nama' => 'Serat Adiluhung',
                'deskripsi' => 'Tulis dan publikasikan 100 artikel',
                'rule' => 'artikel',
                'requirement' => 100, //artikel
                'reward' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // View
            // total tayangan kosakata
            [
                'role' => null,
                'nama' => 'Kamus Jagat',
                'deskripsi' => 'Raih total 1000 tayangan untuk kosakata yang kamu submit.',
                'rule' => 'totalViewKosakata',
                'requirement' => 1000, //view
                'reward' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Wanda Wacana',
                'deskripsi' => 'Raih total 5000 tayangan untuk kosakata yang kamu submit.',
                'rule' => 'totalViewKosakata',
                'requirement' => 5000, //view
                'reward' => 400,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Adiluhung',
                'deskripsi' => 'Raih total 10000 tayangan untuk kosakata yang kamu submit.',
                'rule' => 'totalViewKosakata',
                'requirement' => 10000, //view
                'reward' => 800,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // tayangan 1 kosakata
            [
                'role' => null,
                'nama' => 'Swara Gumebyar',
                'deskripsi' => 'Raih 1000 tayangan dari satu kosakata yang kamu submit.',
                'rule' => 'viewKosakata',
                'requirement' => 1000, //view
                'reward' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Paramarta Basa',
                'deskripsi' => 'Raih 5000 tayangan dari satu kosakata yang kamu submit.',
                'rule' => 'viewKosakata',
                'requirement' => 5000, //view
                'reward' => 400,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => null,
                'nama' => 'Kawruh Mrenaning Jagad',
                'deskripsi' => 'Raih 10000 tayangan dari satu kosakata yang kamu submit.',
                'rule' => 'viewKosakata',
                'requirement' => 10000, //view
                'reward' => 800,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // total tayangan blog
            [
                'role' => 'pengurus',
                'nama' => 'Rontal Pradata',
                'deskripsi' => 'Raih total 1000 tayanan dari semua artikel yang kamu tulis.',
                'rule' => 'totalViewBlog',
                'requirement' => 1000, //view
                'reward' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => 'pengurus',
                'nama' => 'Pratiti Swara',
                'deskripsi' => 'Raih total 5000 tayanan dari semua artikel yang kamu tulis.',
                'rule' => 'totalViewBlog',
                'requirement' => 5000, //view
                'reward' => 400,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => 'pengurus',
                'nama' => 'Tutur Tinular',
                'deskripsi' => 'Raih total 10000 tayanan dari semua artikel yang kamu tulis.',
                'rule' => 'totalViewBlog',
                'requirement' => 10000, //view
                'reward' => 800,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // view 1 artikel
            [
                'role' => 'pengurus',
                'nama' => 'Pawarta Wening',
                'deskripsi' => 'Raih 1000 tayanan dari satu artikel yang kamu tulis.',
                'rule' => 'viewBlog',
                'requirement' => 1000, //view
                'reward' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => 'pengurus',
                'nama' => 'Kawruh Candhala',
                'deskripsi' => 'Raih 5000 tayanan dari satu artikel yang kamu tulis.',
                'rule' => 'viewBlog',
                'requirement' => 5000, //view
                'reward' => 400,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role' => 'pengurus',
                'nama' => 'Tutur Pranaweng',
                'deskripsi' => 'Raih 10000 tayanan dari satu artikel yang kamu tulis.',
                'rule' => 'viewBlog',
                'requirement' => 10000, //view
                'reward' => 800,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
