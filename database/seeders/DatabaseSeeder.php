<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            LevelSeeder::class
        ]);

        // KOSAKATA
        DB::table('kosakata')->insert([
            'kosakata' => 'Madaran',
            'ragam' => 'Krama',
            'aksara' => 'ꦩꦢꦫꦤ꧀',
            'jenis' => 'Kata benda',
            'notasi_fonetik' => 'ma-da-ran',
            'arti_indo' => 'Malam',
            'etimologi' => 'Asli',
            'serupa' => json_encode(['Bengi', 'Dalu']),
            'dibuat_oleh' => 1
        ]);

        DB::table('kosakata')->insert([
            'kosakata' => 'Dalu',
            'dibuat_oleh' => 1
        ]);
    }
}
