<?php

namespace Database\Seeders;

use App\Models\Kosakata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KosakataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // KOSAKATA
        Kosakata::insert([
            'kosakata' => 'Madaran',
            'slug' => 'madaran',
            'ragam' => 'Krama',
            'aksara' => 'ꦩꦢꦫꦤ꧀',
            'jenis' => 'Nomina',
            'notasi_fonetik' => 'ma-da-ran',
            'arti_indo' => 'Perut',
            'etimologi' => json_encode(['Asli']),
            'user_id' => 1,
            'serupa' => json_encode(['weteng']),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Kosakata::insert([
            'kosakata' => 'Dalu',
            'slug' => 'dalu',
            'user_id' => 1,
            'serupa' => json_encode(['bengi']),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Kosakata::factory(50)->create();
    }
}
