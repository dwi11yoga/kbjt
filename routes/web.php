<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// HOMEPAGE
Route::get('/', [HomepageController::class, 'index']);
Route::get('/daftar-kosakata', [HomepageController::class, 'daftarKosakata']);
Route::get('/hall-of-fame', [HomepageController::class, 'hallOfFame']);
Route::get('/blog', [HomepageController::class, 'blog']);
Route::get('/blog/post', [HomepageController::class, 'blogPost']);

Route::get('/donasi', [HomepageController::class, 'donasi']);

Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('/masuk', [UserController::class, 'signin'])->name('login');
    Route::post('/masuk', [UserController::class, 'authenticate']);
    // Daftar
    Route::get('/daftar', [UserController::class, 'signup']);
    Route::post('/daftar', [UserController::class, 'store']);
});

// DASHBOARD
Route::middleware(['auth'])->group(function () {
    // Dashboard view
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // Logout
    Route::post('/logout', [UserController::class, 'logout']);

    // kontribusi
    Route::get('/kontribusi', [DashboardController::class, 'kontribusi']);
    // achivement
    Route::get('/achivement', [DashboardController::class, 'achivement']);
    // sertifikat
    Route::get('/sertifikat', [DashboardController::class, 'sertifikat']);

    // Pengaturan
    Route::get('/pengaturan', [DashboardController::class, 'settings']);
    // Ubah data diri
    Route::get('/pengaturan/edit-user', [UserController::class, 'editUser']);
    // Simpan perubahan data diri
    Route::put('/pengaturan/edit-user', [UserController::class, 'update']);
});