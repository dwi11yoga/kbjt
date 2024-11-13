<?php

namespace Database\Seeders;

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
            'password' => Hash::make('muklistampan'),
            'tgl_lahir' => '2000-12-01',
            'kota' => 'Pati',
            'jenis_kelamin' => 'Laki-laki',
            'profile_pic' => 'https://cdn.thefairnews.co.kr/news/photo/202404/25369_59232_5627.jpg',
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus necessitatibus tenetur voluptates at quis quae voluptatum suscipit fugiat, molestiae vel dolores officia illo, dolorum asperiores, perspiciatis natus facere aperiam ratione.',
            'telp' => '089726514414',
            'pekerjaan' => 'Founder PeduliBudayaJawa.org',
            'hobi' => 'Memancing',
            'tampilkan_email' => true,
        ]);
    }
}
