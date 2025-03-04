<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DefinisiController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\EditKosakataController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HukumanController;
use App\Http\Controllers\KosakataController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PoinKontribusiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TrixController;
use App\Http\Controllers\UserController;
use App\Models\EditKosakata;
use Illuminate\Support\Facades\Route;

// HOMEPAGE
Route::get('/', [HomepageController::class, 'index']);
// daftar kosakata
Route::get('/daftar-kosakata', [HomepageController::class, 'daftarKosakata']);
// hall of fame
Route::get('/hall-of-fame', [HomepageController::class, 'hallOfFame']);
// blog
Route::get('/blog', [HomepageController::class, 'blog']);
// post/artikel
Route::get('/blog/post/{slug}', [HomepageController::class, 'blogPost']);
// donasi
Route::get('/donasi', [HomepageController::class, 'donasi']);
// pencarian
Route::get('/cari', [HomepageController::class, 'pencarian']);

// tambah kosakata
Route::get('/tambah/kosakata', [KosakataController::class, 'tambahKosakata'])->middleware('auth');
// simpan kosakata
Route::post('/tambah/kosakata', [KosakataController::class, 'store'])->middleware('auth');
// tampilkan definisi & kosakata
Route::get('/kosakata/{slug}', [HomepageController::class, 'kosakata']);
// riwayat edit
Route::get('/kosakata/{slug}/riwayat', [HomepageController::class, 'riwayatKosakata']);
// Profil user
Route::get('/u/{username}', [UserController::class, 'profile']);

// tampilan sertifikat
Route::get('/s/{userId}{sertifikatId}', [SertifikatController::class, 'detail']);

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
    // achivement - semua achievement
    Route::get('/achievement', [AchievementController::class, 'index']);

    // sertifikat - semua
    Route::get('/sertifikat', [SertifikatController::class, 'index']);
    // klaim sertifikat
    Route::post('/sertifikat/klaim/{id}', [SertifikatController::class, 'klaim'])->middleware('kontributorPengurus');

    // laporkan definisi
    Route::post('/laporkan/definisi', [ReportController::class, 'definisi']);
    // laporkan (hapus) kosakata 
    route::post('/kosakata/{slug}/laporkan', [ReportController::class, 'kosakata']);
    // detail laporan (kontributor)
    Route::get('/kontribusi/laporan/{id}', [ReportController::class, 'detailLaporan']);

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

        // banner
        Route::get('/banner', [BannerController::class, 'index']);

        // kontributor - pengurus
        Route::get('/kontributor', [DashboardController::class, 'kontributor']);

        // pengurus - pengurus
        Route::get('/pengurus', [DashboardController::class, 'pengurus']);
        // laporan - pengurus
        Route::get('/laporan', [ReportController::class, 'index']);
        Route::get('/laporan/{id}', [ReportController::class, 'detailLaporan']);
    });

    Route::middleware(['kepala'])->group(function () {
        // donasi - kepala
        Route::get('/metode-donasi', [DonasiController::class, 'index']);
        // tambah donasi - kepala
        Route::get('/metode-donasi/baru', [DonasiController::class, 'tambah']);
        // simpan tambah donasi donasi
        Route::post('/metode-donasi/baru', [DonasiController::class, 'save']);
        // edit donasi - kepala
        Route::get('/metode-donasi/{id}/edit', [DonasiController::class, 'edit']);
        // simpan edit donasi
        Route::put('/metode-donasi/{id}/edit', [DonasiController::class, 'store']);

        // level - kepala
        Route::get('/level', [LevelController::class, 'index']);
        // tambah level - kepala
        Route::post('/level/tambah', [LevelController::class, 'create']);
        // update level - kepala
        Route::put('/level/update', [LevelController::class, 'update']);
        // update poin kontribusi - kepala
        Route::put('/poin-kontribusi/update', [PoinKontribusiController::class, 'update']);

        // tambah achievement
        Route::get('/achievement/baru', [AchievementController::class, 'tambah']);
        // simpan achievement baru
        Route::post('/achievement/baru', [AchievementController::class, 'save']);
        // edit achievement
        Route::get('achievement/{id}/edit', [AchievementController::class, 'edit']);
        // simpan edit achievement
        Route::put('/achievement/{id}/edit', [AchievementController::class, 'simpanEdit']);
    });

    Route::middleware(['pengurus'])->group(function () {
        // buat artikel
        Route::get('/artikel/baru', [BlogController::class, 'tambah']);
        // edit artikel
        Route::get('/artikel/edit/{id}', [BlogController::class, 'editPost']);
        // simpan artikel
        Route::post('/artikel/baru/simpan', [BlogController::class, 'simpanArtikel']);
        // publikasikan artikel
        Route::post('/artikel/baru/publikasikan', [BlogController::class, 'simpanArtikel']);
        // simpan artikel (draft)
        Route::put('/artikel/edit/{id}/simpan', [BlogController::class, 'simpanEdit']);
        // publikasikan artikel yang disimpan sebagai draft
        Route::put('/artikel/edit/{id}/publikasikan', [BlogController::class, 'simpanEdit']);

        // simpan perubahan pada data laporan
        Route::put('/laporan/{id}/tindaklanjut', [ReportController::class, 'tindaklanjut']);
        // simpan hukuman yang diberikan
        // Route::post('/laporan/{id}/hukuman', [HukumanController::class, 'tindaklanjut']);

        // setujui edit definisi
        Route::put('/kosakata/{slug}/riwayat/{id}/setujui', [EditKosakataController::class, 'setujui']);
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
    Route::get('/kosakata/{slug}/edit', [EditKosakataController::class, 'edit']);
    Route::post('/kosakata/{slug}/edit', [EditKosakataController::class, 'simpanEdit']);
});