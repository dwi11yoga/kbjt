<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //User
        DB::table('users')->insert([
            'nama' => 'Muklis Ambatukam',
            'username' => 'moeklis',
            'email' => Str::random(10) . '@example.com',
            'password' => Hash::make('muklis1'),
            'poin' => random_int(10, 10000),
            'created_at' => now()
        ]);

        User::factory(100)->create();
    }
}
