<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// HOMEPAGE
Route::get('/', function () {
    return view('homepage/homepage', ['group' => 'homepage', 'title' => 'Selamat datang di Kamus Bahasa Jawa Terbuka!']);
});

Route::get('/daftar-kosakata', function () {
    return view('homepage.daftar-kosakata', ['group' => 'kosakata', 'title' => 'Daftar Kosakata']);
});

Route::get('/hall-of-fame', function () {
    return view('homepage.hall-of-fame', ['group' => 'hall of fame', 'title' => 'Hall of Fame']);
});
Route::get('/blog', function () {
    return view('homepage.blog', ['group' => 'blog', 'title' => 'Blog']);
});

Route::get('/blog/post', function () {
    return view('homepage.post', [
        'group' => 'blog',
        'title' => '
    Post'
    ]);
});

Route::get('/donasi', function () {
    return view('homepage.donasi', ['group' => 'donasi', 'title' => 'Donasi']);
});

Route::get('/masuk', function () {
    return view('homepage.login', ['group' => 'login', 'title' => 'Masuk']);
});

Route::get('/daftar', function () {
    return view('homepage.signup', ['group' => 'login', 'title' => 'Buat akun']);
});
Route::post('/buat-akun', [UserController::class, 'store']);

// DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard.dashboard', ['group' => 'dashboard', 'title' => 'Dashboard']);
});