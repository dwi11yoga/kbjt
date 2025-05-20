<?php

namespace Database\Seeders;

use App\Models\Level;
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
        $requirement = [
            1,
            100,
            300,
            600,
            1000,
            1500,
            2100,
            2800,
            3500,
            4500

        ];

        for ($i = 1; $i <= 10; $i++) {

            $level[$i] = [
                'lvl' => $i,
                'min_poin' => $requirement[$i - 1],
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        }

        // Level Seeder
        Level::insert($level);
    }
}
