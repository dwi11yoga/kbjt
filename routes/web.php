<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage/homepage');
});

Route::get('/daftar-kosakata', function () {
    return view('homepage.daftar-kosakata');
});
