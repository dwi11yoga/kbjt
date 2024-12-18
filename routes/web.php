<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DefinisiController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KosakataController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PoinKontribusiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// HOMEPAGE
Route::get('/', [HomepageController::class, 'index']);
Route::get('/daftar-kosakata', [HomepageController::class, 'daftarKosakata']);
Route::get('/hall-of-fame', [HomepageController::class, 'hallOfFame']);
Route::get('/blog', [HomepageController::class, 'blog']);
Route::get('/blog/post', [HomepageController::class, 'blogPost']);
Route::get('/donasi', [HomepageController::class, 'donasi']);
Route::get('/cari', [HomepageController::class, 'pencarian']);
Route::get('/tambah/kosakata', [KosakataController::class, 'tambahKosakata'])->middleware('auth');
Route::post('/tambah/kosakata', [KosakataController::class, 'store'])->middleware('auth');
Route::get('/kosakata/{slug}', [HomepageController::class, 'kosakata']);
// Profil user
Route::get('/u/{username}', [UserController::class, 'profile']);
// Akses ditolak
Route::get('/akses-ditolak', function () {
    return view('403', [
        'title' => 'Akses ditolak',
        'group' => ''
    ]);
});

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

    // kontribusi - kontributor
    Route::get('/kontribusi', [DashboardController::class, 'kontribusi']);
    // achivement - kontributor & pengurus
    Route::get('/achivement', [DashboardController::class, 'achivement']);
    // sertifikat - kontributor & pengurus
    Route::get('/sertifikat', [DashboardController::class, 'sertifikat']);

    Route::middleware(['pengurusKepala'])->group(function () {
        // artikel - pengurus & kepala
        Route::get('/artikel', function () {
            return view('dashboard.artikel', [
                'title' => 'Artikel',
                'group' => 'artikel'
            ]);
        });
        // banner - pengurus & kepala
        Route::get('/banner', function () {
            return view('dashboard.artikel', [
                'title' => 'Banner',
                'group' => 'banner'
            ]);
        });
        // kontributor - pengurus
        Route::get('/kontributor', function () {
            return view('dashboard.artikel', [
                'title' => 'Kontributor',
                'group' => 'kontributor'
            ]);
        });
        // pengurus - pengurus
        Route::get('/pengurus', function () {
            return view('dashboard.artikel', [
                'title' => 'Pengurus',
                'group' => 'pengurus'
            ]);
        });
        // laporan - pengurus
        Route::get('/laporan', function () {
            return view('dashboard.artikel', [
                'title' => 'Laporan',
                'group' => 'laporan'
            ]);
        });
    });

    Route::middleware(['kepala'])->group(function () {
        // donasi - kepala
        Route::get('/metode-donasi', function () {
            return view('dashboard.artikel', [
                'title' => 'Donasi',
                'group' => 'donasi'
            ]);
        });

        // level - kepala
        Route::get('/level', [LevelController::class, 'index']);
        // tambah level - kepala
        Route::post('/level/tambah', [LevelController::class, 'create']);
        // update level - kepala
        Route::put('/level/update', [LevelController::class, 'update']);
        // update poin kontribusi - kepala
        Route::put('/poin-kontribusi/update', [PoinKontribusiController::class, 'update']);
    });


    // Pengaturan
    Route::get('/pengaturan', [DashboardController::class, 'settings']);
    // Ubah data diri
    Route::get('/pengaturan/edit-user', [UserController::class, 'editUser']);
    // Simpan perubahan data diri
    Route::put('/pengaturan/edit-user', [UserController::class, 'update']);
    // Simpan edit password
    Route::put('/pengaturan/ganti-password', [UserController::class, 'updatePassword']);

    // Tambah definisi
    Route::post('/kosakata/{slug}/buat-definisi', [DefinisiController::class, 'create']);
    // Edit definisi
    Route::put('/kosakata/{slug}/{definisiId}/update', [DefinisiController::class, 'update']);
    // Hapus definisi
    Route::delete('/kosakata/{slug}/{definisiId}/delete', [DefinisiController::class, 'delete']);

    // Edit kosakata
    Route::get('/kosakata/{slug}/edit', [KosakataController::class, 'edit']);
    Route::post('/kosakata/{slug}/edit', [KosakataController::class, 'simpanEdit']);
});