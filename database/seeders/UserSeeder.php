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
        User::insert([
            [
                'nama' => 'Muklis Hartono',
                'username' => 'moeklis',
                'role' => 'kepala',
                'email' => 'moeklis@kbjt.com',
                'password' => Hash::make('muklis1'),
                'poin' => 1,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Supriyanto',
                'username' => 'supriyanto',
                'role' => 'pengurus',
                'email' => 'supriyanto@kbjt.com',
                'password' => Hash::make('password'),
                'poin' => random_int(10, 1000),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Amar Goyono',
                'username' => 'margoyono',
                'role' => 'pengurus',
                'email' => 'aguskuncoro@kbjt.com',
                'password' => Hash::make('password'),
                'poin' => random_int(10, 1000),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Susilowati',
                'username' => 'susilowati',
                'role' => 'kontributor',
                'email' => 'susilowati@gmail.com',
                'password' => Hash::make('password'),
                'poin' => random_int(10, 1000),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        User::factory(100)->create();
    }
}
