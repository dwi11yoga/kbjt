<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Level Seeder
        DB::table('levels')->insert([
            'lvl' => 1,
            'min_poin' => 1,
        ]);

        DB::table('levels')->insert([
            'lvl' => 2,
            'min_poin' => 100,
        ]);

        DB::table('levels')->insert([
            'lvl' => 3,
            'min_poin' => 200,
        ]);

        DB::table('levels')->insert([
            'lvl' => 4,
            'min_poin' => 400,
        ]);
    }
}
