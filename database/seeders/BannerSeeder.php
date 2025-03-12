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
            'name' => 'sidebanner-1',
            'link' => 'http://127.0.0.1:8000/banner'
        ]);
        Banner::insert([
            'name' => 'sidebanner-2',
            'link' => 'http://127.0.0.1:8000/blog/post/lorem-ipsum-dolor-sit-amet'
        ]);
        Banner::insert([
            'name' => 'artikelbanner-1',
            'link' => 'http://127.0.0.1:8000/'
        ]);
        Banner::insert([
            'name' => 'artikelbanner-2',
            'link' => 'http://127.0.0.1:8000/hall-of-fame'
        ]);
        Banner::insert([
            'name' => 'kosakata-1',
            'link' => 'http://127.0.0.1:8000/blog/post/lorem-ipsum-dolor-sit-amet'
        ]);
        Banner::insert([
            'name' => 'kosakata-2',
            'link' => 'http://127.0.0.1:8000/'
        ]);
        Banner::insert([
            'name' => 'dashboard-1',
            'link' => 'http://127.0.0.1:8000/hall-of-fame'
        ]);
    }
}