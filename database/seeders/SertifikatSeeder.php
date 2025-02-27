<?php

namespace Database\Seeders;

use App\Models\Sertifikat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SertifikatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Sertifikat::insert([
            [
                'nama' => 'Menjadi bagian dari komunitas KBJT lebih dari satu tahun',
                'role' => null,
                'rule' => 'keanggotaan',
                'requirement' => 360, // hari
                'reward' => 500
            ],
            [
                'nama' => 'Menjadi bagian dari komunitas KBJT lebih dari lima tahun',
                'role' => null,
                'rule' => 'keanggotaan',
                'requirement' => 360 * 5, // hari
                'reward' => 2500
            ],
            [
                'nama' => 'Memberikan total 1000 kontribusi dalam komunitas',
                'role' => null,
                'rule' => 'kontribusi',
                'requirement' => 1000, // kontribusi
                'reward' => 200,
            ],
            [
                'nama' => 'Memberikan total 10000 kontribusi dalam komunitas',
                'role' => null,
                'rule' => 'kontribusi',
                'requirement' => 10000, // kontribusi
                'reward' => 1000,
            ],
            [
                'nama' => 'Memberikan total 1000 kontribusi dalam komunitas sebagai pengurus',
                'role' => 'pengurus',
                'rule' => 'kontribusiPengurus',
                'requirement' => 1000, // kontribusi
                'reward' => 2000,
            ],
            [
                'nama' => 'Memberikan total 10000 kontribusi dalam komunitas sebagai pengurus',
                'role' => 'pengurus',
                'rule' => 'kontribusiPengurus',
                'requirement' => 10000, // kontribusi
                'reward' => 5000,
            ],
        ]);
    }
}
