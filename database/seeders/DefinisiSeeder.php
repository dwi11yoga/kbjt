<?php

namespace Database\Seeders;

use App\Models\Definisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefinisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definisi
        Definisi::insert([
            'kosakata_id' => 1,
            'user_id' => 1,
            'definisi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore assumenda iure quasi vero architecto voluptas repellendus ad? Iste, vero voluptas.',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Definisi::insert([
            'kosakata_id' => 1,
            'user_id' => random_int(2, 100),
            'definisi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ipsum, tenetur ipsa praesentium ut dignissimos.',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Definisi::insert([
            'kosakata_id' => 1,
            'user_id' => random_int(2, 100),
            'definisi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore assumenda iure quasi vero architecto voluptas repellendus ad? Iste, vero voluptas.',
            'referensi' => json_encode(['https://google.com/images']),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Definisi::factory(100)->create();
    }
}
