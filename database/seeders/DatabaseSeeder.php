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
            LevelSeeder::class,
            PoinKontribusiSeeder::class
        ]);

        // KOSAKATA
        DB::table('kosakata')->insert([
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
        ]);

        DB::table('kosakata')->insert([
            'kosakata' => 'Dalu',
            'slug' => 'dalu',
            'user_id' => 1,
            'serupa' => json_encode(['bengi']),
        ]);

        // Definisi
        DB::table('definisi')->insert([
            'kosakata_id' => 1,
            'user_id' => 1,
            'definisi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore assumenda iure quasi vero architecto voluptas repellendus ad? Iste, vero voluptas.',
            'contoh' => json_encode(['Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab, possimus!']),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('definisi')->insert([
            'kosakata_id' => 1,
            'user_id' => 1,
            'definisi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ipsum, tenetur ipsa praesentium ut dignissimos.',
            'referensi' => json_encode(['https://id.wikipedia.org/wiki/Bahasa_Jawa', 'https://stackoverflow.com/questions/40375022/how-to-parse-datetime-using-laravel-on-date-and-time']),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('definisi')->insert([
            'kosakata_id' => 1,
            'user_id' => 1,
            'definisi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore assumenda iure quasi vero architecto voluptas repellendus ad? Iste, vero voluptas.',
            'contoh' => json_encode(['Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab, possimus!']),
            'referensi' => json_encode(['https://google.com/images']),
            'created_at' => now(),
            'updated_at' => now()
        ]);

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
    }

}
