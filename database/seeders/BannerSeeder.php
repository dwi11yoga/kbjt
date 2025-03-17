<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Banner::insert([
            'name' => 'Banner 1: Sidebar',
            'url' => 'http://127.0.0.1:8000/banner',
            'catatan'=>'Banner ini ditampilkan di bagian sidebar. Disasrankan menggunakan gambar berorientasi kotak atau portrait',
        ]);
        Banner::insert([
            'name' => 'Banner 2: Sidebar',
            'url' => 'http://127.0.0.1:8000/blog/post/lorem-ipsum-dolor-sit-amet',
            'catatan'=>'Banner ini ditampilkan di bagian sidebar. Disasrankan menggunakan gambar berorientasi kotak atau portrait',
        ]);
        Banner::insert([
            'name' => 'Banner 3: Artikel',
            'url' => 'http://127.0.0.1:8000/',
            'catatan'=>'Banner ini ditampilkan pada halaman artikel. Disasrankan menggunakan gambar berorientasi landscape',
        ]);
        Banner::insert([
            'name' => 'Banner 4: Artikel',
            'url' => 'http://127.0.0.1:8000/hall-of-fame',
            'catatan'=>'Banner ini ditampilkan pada halaman artikel. Disasrankan menggunakan gambar berorientasi landscape',
        ]);
        Banner::insert([
            'name' => 'Banner 5: Definisi Kosakata',
            'url' => 'http://127.0.0.1:8000/blog/post/lorem-ipsum-dolor-sit-amet',
            'catatan'=>'Banner ini ditampilkan pada halaman definisi kosakata. Disasrankan menggunakan gambar berorientasi landscape',
        ]);
        Banner::insert([
            'name' => 'Banner 6: Definisi Kosakata',
            'url' => 'http://127.0.0.1:8000/',
            'catatan'=>'Banner ini ditampilkan pada halaman definisi kosakata. Disasrankan menggunakan gambar berorientasi landscape',
        ]);
        Banner::insert([
            'name' => 'Banner 7: Dashboard',
            'url' => 'http://127.0.0.1:8000/hall-of-fame',
            'catatan'=>'Banner ini ditampilkan pada halaman dashboard. Disasrankan menggunakan gambar berorientasi landscape',
        ]);
    }
}