<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage/homepage');
});

Route::get('/daftar-kosakata', function () {
    return view('homepage.daftar-kosakata');
});

Route::get('/hall-of-fame', function () {
    return view('homepage.hall-of-fame');
});

Route::get('/blog', function () {
    return view('homepage.blog');
});

Route::get('/donasi', function () {
    return view('homepage.donasi');
});

Route::get('/masuk', function () {
    return view('homepage.login');
});