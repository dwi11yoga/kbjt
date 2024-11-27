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
            'slug' => 'madaran',
            'ragam' => 'Krama',
            'aksara' => 'ꦩꦢꦫꦤ꧀',
            'jenis' => 'Nomina',
            'notasi_fonetik' => 'ma-da-ran',
            'arti_indo' => 'Malam',
            'etimologi' => json_encode(['Asli']),
            'dibuat_oleh' => 1,
            'serupa' => json_encode(['Bengi', 'Dalu']),
        ]);

        DB::table('kosakata')->insert([
            'kosakata' => 'Dalu',
            'slug' => 'dalu',
            'dibuat_oleh' => 1
        ]);
    }
}
