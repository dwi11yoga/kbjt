<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DefinisiController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KosakataController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PoinKontribusiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TrixController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// HOMEPAGE
Route::get('/', [HomepageController::class, 'index']);
Route::get('/daftar-kosakata', [HomepageController::class, 'daftarKosakata']);
Route::get('/hall-of-fame', [HomepageController::class, 'hallOfFame']);
Route::get('/blog', [HomepageController::class, 'blog']);
Route::get('/blog/post/{slug}', [HomepageController::class, 'blogPost']);
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

// TRIX
// Upload gambar
Route::post('/upload-image', [TrixController::class, 'store']);
// Delete gambar
Route::post('/delete-image', [TrixController::class, 'delete']);

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

    // laporkan definisi
    Route::post('/laporkan/definisi', [ReportController::class, 'definisi']);

    Route::middleware(['pengurusKepala'])->group(function () {

        // artikel - pengurus & kepala
        Route::get('/artikel', [BlogController::class, 'index']);
        // preview artikel
        Route::get('/blog/preview/{slug}', [HomepageController::class, 'blogPost']);
        // Edit artikel/post
        Route::get('/artikel/edit/{id}', [BlogController::class, 'editPost']);
        // draf/terbitkan post
        Route::put('/artikel/draf/{id}', [BlogController::class, 'draft']);
        // sematkan/tidak post
        Route::put('/artikel/sematkan/{id}', [BlogController::class, 'sematkan']);
        // hapus artikel
        Route::delete('/artikel/hapus/{id}', [BlogController::class, 'delete']);

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

        // banner
        Route::get('/banner', [BannerController::class, 'index']);

        // level - kepala
        Route::get('/level', [LevelController::class, 'index']);
        // tambah level - kepala
        Route::post('/level/tambah', [LevelController::class, 'create']);
        // update level - kepala
        Route::put('/level/update', [LevelController::class, 'update']);
        // update poin kontribusi - kepala
        Route::put('/poin-kontribusi/update', [PoinKontribusiController::class, 'update']);
    });

    Route::middleware(['pengurus'])->group(function () {
        Route::get('/artikel/baru', [BlogController::class, 'tambah']);
        Route::get('/artikel/edit/{id}', [BlogController::class, 'editPost']);
        Route::post('/artikel/baru/simpan', [BlogController::class, 'simpanArtikel']);
        Route::post('/artikel/baru/publikasikan', [BlogController::class, 'simpanArtikel']);
        Route::put('/artikel/edit/{id}/simpan', [BlogController::class, 'simpanEdit']);
        Route::put('/artikel/edit/{id}/publikasikan', [BlogController::class, 'simpanEdit']);
    });


    // Pengaturan
    Route::get('/pengaturan', [DashboardController::class, 'settings']);
    // Ubah data diri
    Route::get('/pengaturan/edit-user', [UserController::class, 'editUser']);
    // Simpan perubahan data diri
    Route::put('/pengaturan/edit-user', [UserController::class, 'update']);
    // Simpan edit password
    Route::put('/pengaturan/ganti-password', [UserController::class, 'updatePassword']);
    // Simpan edit email
    Route::put('/pengaturan/ganti-email', [UserController::class, 'updateEmail']);
    // sembunyikan data sensitif
    Route::put('/pengaturan/data-sensitif', [UserController::class, 'dataSensitif']);

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