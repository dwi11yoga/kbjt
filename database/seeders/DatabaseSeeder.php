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

        // Edit kosakata
        DB::table('editkosakata')->insert([
            'user_id' => 1,
            'kosakata_id' => 1,
            'slug' => 'madaran',
            'ragam' => 'Krama',
            'aksara' => 'ꦩꦢꦫꦤ꧀',
            'jenis' => 'Nomina',
            'notasi_fonetik' => 'ma-da-ran',
            'arti_indo' => 'Perut',
            'etimologi' => json_encode(['Asli']),
            'serupa' => json_encode(['weteng']),
        ]);

        $this->call([
            BannerSeeder::class,
            BlogSeeder::class,
            DefinisiSeeder::class,
            KosakataSeeder::class,
            ReportSeeder::class,
            LevelSeeder::class,
            PoinKontribusiSeeder::class,
            UserSeeder::class,
        ]);
    }

}
