<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //Beranda
    public function index()
    {
        return view('homepage.index', [
            'group' => 'homepage',
            'title' => 'Selamat datang di Kamus Bahasa Jawa Terbuka!'
        ]);
    }

    // Daftar Kosakata
    public function daftarKosakata()
    {
        return view('homepage.daftar-kosakata', [
            'group' => 'kosakata',
            'title' => 'Daftar Kosakata'
        ]);
    }

    // Hall of Fame
    public function hallOfFame()
    {
        return view('homepage.hall-of-fame', [
            'group' => 'hall of fame',
            'title' => 'Hall of Fame'
        ]);
    }

    // Blog
    public function blog()
    {
        return view('homepage.blog', [
            'group' => 'blog',
            'title' => 'Blog'
        ]);
    }

    // Blog Post
    public function blogPost()
    {
        return view('homepage.post', [
            'group' => 'blog',
            'title' => 'Post'
        ]);
    }

    // Donasi
    public function donasi()
    {
        return view('homepage.donasi', [
            'group' => 'donasi',
            'title' => 'Donasi'
        ]);
    }
}
