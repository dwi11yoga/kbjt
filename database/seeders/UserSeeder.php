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
                'nama' => 'Anwar Mashudi',
                'username' => 'moeklis',
                'role' => 'kepala',
                'email' => 'moeklis@kbjt.com',
                'password' => Hash::make('muklis1'),
                'poin' => 1,
                'profile_pic' => 'profile-pics/Q5cKx60ohkIzkU2N0qkWL0DdDSYqTH0Y38AbQERs.jpg',
                'tgl_lahir' => '1989-12-05',
                'kota' => 'Pati, Jawa Tengah',
                'jenis_kelamin' => 'Laki-laki',
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
                'profile_pic' => 'profile-pics/WFpNq9ZMIBAI6ruSRPY4GeUucAjyWXAWQZZL1KOB.jpg',
                'tgl_lahir' => '1972-06-23',
                'kota' => 'Pati, Jawa Tengah',
                'jenis_kelamin' => 'Laki-laki',
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
                'profile_pic' => NULL,
                'tgl_lahir' => NULL,
                'kota' => NULL,
                'jenis_kelamin' => NULL,
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
                'profile_pic' => 'profile-pics/ShCzc3Hs8Fl712y060spkNLaw6eXhXlCfDIgrrWX.jpg',
                'tgl_lahir' => '1968-05-05',
                'kota' => 'Pati, Jawa Tengah',
                'jenis_kelamin' => 'Perempuan',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        User::factory(100)->create();
    }
}
