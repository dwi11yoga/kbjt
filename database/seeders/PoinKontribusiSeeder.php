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
        PoinKontribusi::create([
            'role' => 'kontributor',
            'kontribusi' => 'Menambah kosakata',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic quia quos est odit autem, et aperiam quam vero ea ipsam.',
            'poin' => 20,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        PoinKontribusi::create([
            'role' => 'kontributor',
            'kontribusi' => 'Menambah definisi',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic quia quos est odit autem.',
            'poin' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        PoinKontribusi::create([
            'role' => 'kontributor',
            'kontribusi' => 'Mengedit kosakata',
            'poin' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        PoinKontribusi::create([
            'role' => 'pengurus',
            'kontribusi' => 'Verifikasi definisi',
            'poin' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
