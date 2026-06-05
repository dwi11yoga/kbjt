<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DefinisiController;
use App\Http\Controllers\EditKosakataController;
use App\Http\Controllers\HapusAkunController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HukumanController;
use App\Http\Controllers\KosakataController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PoinKontribusiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\TrixController;
use App\Http\Controllers\UserController;
use App\Models\Definisi;
use App\Models\EditKosakata;
use Illuminate\Support\Facades\Route;

// HOMEPAGE
// Route::get('/', [HomepageController::class, 'index']);
Route::livewire('/', 'pages::homepages.index');

// alih aksara: konversi tulisan latin ke aksara jawa
Route::livewire('/alih-aksara', 'pages::homepages.converter');

// daftar kosakata
// Route::get('/daftar-kosakata', [HomepageController::class, 'daftarKosakata']);
Route::livewire('/kosakata', 'pages::homepages.word-list');

// hall of fame
// Route::get('/hall-of-fame', [HomepageController::class, 'hallOfFame']);
Route::livewire('/hall-of-fame', 'pages::homepages.hall-of-fame');

// blog
// Route::get('/blog', [HomepageController::class, 'blog']);
Route::livewire('/blog', 'pages::homepages.blog');

// post/artikel
// Route::get('/blog/post/{slug}', [HomepageController::class, 'blogPost']);
Route::livewire('/blog/{slug}', 'pages::homepages.blog-post');

// halaman dukung
// Route::get('/dukung', [HomepageController::class, 'dukung']);

// pencarian
// Route::get('/cari', [HomepageController::class, 'pencarian']);
Route::livewire('/cari', 'pages::homepages.search');

// credit
// Route::get('/tentang', [HomepageController::class, 'tentang']);
Route::livewire('/tentang', 'pages::homepages.about');

// syarat dan ketentuan
// Route::get('/syarat-ketentuan', [HomepageController::class, 'syaratKetentuan']);
Route::livewire('/syarat-ketentuan', 'pages::homepages.policies');

// tampilkan definisi & kosakata
// Route::get('/kosakata/{slug}', [HomepageController::class, 'kosakata']);
Route::livewire('/kosakata/{word}', 'pages::homepages.word-detail');

// riwayat edit
// Route::get('/kosakata/{slug}/riwayat', [HomepageController::class, 'riwayatKosakata']);

// Profil user
// Route::get('/u/{username}', [UserController::class, 'profile']);
Route::livewire('/u/{username}', 'pages::homepages.user-detail');
Route::livewire('/u/{username}/{tab}', 'pages::homepages.user-detail');

// tampilan sertifikat
// pakai 's' saja agar tidak sama dengan route untuk edit sertifikat
// Route::get('/s/{userId}/{sertifikatId}', [SertifikatController::class, 'detailSertifikat']);
Route::livewire('/s/{userId}/{sertifikatId}', 'pages::certificate');

// Akses ditolak
Route::get('/akses-ditolak', function () {
    abort(403, 'Lorem ipsum dolor sit amet');
});

// view untuk user terbanned atau akunnya dihapus
// Route::get('/akses-gagal', [HomepageController::class, 'dibanned']);
Route::livewire('/akses-gagal', 'pages::homepages.banned');

// TRIX
// Upload gambar
Route::post('/upload-image', [TrixController::class, 'store']);
// Delete gambar
Route::post('/delete-image', [TrixController::class, 'delete']);

// hanya bisa diakses  jika user belum login
Route::middleware(['guest'])->group(function () {
    // Login
    // Route::get('/masuk', [UserController::class, 'signin'])->name('login');
    // Route::post('/masuk', [UserController::class, 'authenticate']);
    Route::livewire('/masuk', 'pages::homepages.login')->name('login');
    // Daftar
    // Route::get('/daftar', [UserController::class, 'signup']);
    // Route::post('/daftar', [UserController::class, 'store']);
    Route::livewire('/daftar', 'pages::homepages.signup');

    // Verifikasi user/email
    // dijalankan setelah daftar
    Route::get('/daftar/verifikasi', [UserController::class, 'verifikasiUser']);
    Route::put('/daftar/verifikasi', [UserController::class, 'fungsiverifikasiUser']);


    // LUPA KATA SANDI
    // halaman masukkan email untuk reset kata sandi
    // Route::get('/reset-kata-sandi', [UserController::class, 'lupaSandi']);
    // Route::post('/reser-kata-sandi/eksekusi', [UserController::class, 'fungsiLupaSandi']);
    Route::livewire('/reset-kata-sandi', 'pages::homepages.reset-password');
    // autentikasi reset kata sandi
    // Route::get('/reset-kata-sandi/autentikasi', [UserController::class, 'autentikasiLupaSandi']);
    // Route::post('/reset-kata-sandi/autentikasi/elsekusi', [UserController::class, 'fungsiAutentikasiLupaSandi']);
    Route::livewire('/reset-kata-sandi/autentikasi', 'pages::homepages.change-password');
});

// DASHBOARD
Route::middleware(['auth'])->group(function () {
    // Dashboard view
    // Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::livewire('/dashboard', 'pages::dashboards.index');
    // Logout
    // Route::post('/logout', [UserController::class, 'logout']);

    // kontribusi - kontributor
    // Route::get('/kontribusi', [DashboardController::class, 'kontribusi']);
    Route::livewire('/kontribusi', 'pages::dashboards.contribution');
    // achivement - semua achievement
    // Route::get('/achievement', [AchievementController::class, 'index']);
    Route::livewire('/achievement', 'pages::dashboards.achievements');


    // sertifikat - semua
    // Route::get('/sertifikat', [SertifikatController::class, 'index']);
    Route::livewire('/sertifikat', 'pages::dashboards.certificates');
    // klaim sertifikat
    // Route::post('/sertifikat/klaim/{id}', [SertifikatController::class, 'klaim'])->middleware('kontributorPengurus');
    // tambah sertifikat
    // Route::get('/sertifikat/tambah', [SertifikatController::class, 'tambah'])->middleware('kepala');
    // Route::post('/sertifikat/tambah', [SertifikatController::class, 'simpanTambah'])->middleware('kepala');
    Route::livewire('/sertifikat/tambah', 'pages::dashboards.certificate-new')->middleware('kepala');
    // edit sertifikat
    // Route::get('/sertifikat/edit/{id}', [SertifikatController::class, 'edit'])->middleware('kepala');
    // Route::post('/sertifikat/edit/{id}', [SertifikatController::class, 'simpanEdit'])->middleware('kepala');
    Route::livewire('/sertifikat/edit/{id}', 'pages::dashboards.certificate-edit')->middleware('kepala');


    // laporkan definisi
    Route::post('/laporkan/definisi', [ReportController::class, 'definisi']);
    // laporkan (hapus) kosakata 
    route::post('/kosakata/{slug}/laporkan', [ReportController::class, 'kosakata']);

    // detail laporan
    // Route::get('/laporan/{id}', [ReportController::class, 'detailLaporan']);
    Route::livewire('/laporan/{id}', 'pages::dashboards.report-detail');

    // hanya untuk role pengurus dan kepala
    Route::middleware(['pengurusKepala'])->group(function () {

        // artikel - pengurus & kepala
        // Route::get('/artikel', [BlogController::class, 'index']);
        Route::livewire('/artikel', 'pages::dashboards.articles');

        // preview artikel
        Route::get('/blog/preview/{slug}', [HomepageController::class, 'blogPost']);
        // Edit artikel/post -> kepala tidak bisa edit artikel, jadi ini tidak usah 
        // Route::get('/artikel/edit/{id}', [BlogController::class, 'editPost']);
        // draf/terbitkan post
        Route::put('/artikel/draf/{id}', [BlogController::class, 'draft']);
        // sematkan/tidak post
        Route::put('/artikel/sematkan/{id}', [BlogController::class, 'sematkan']);
        // hapus artikel
        Route::delete('/artikel/hapus/{id}', [BlogController::class, 'delete']);

        // banner
        // Route::get('/banner', [BannerController::class, 'index']);
        Route::livewire('/iklan', 'pages::dashboards.banners');
        // perbarui data banner
        // Route::put('/banner', [BannerController::class, 'store']);

        // kontributor - pengurus
        // Route::get('/kontributor', [DashboardController::class, 'kontributor']);
        Route::livewire('/kontributor', 'pages::dashboards.contributors');

        // pengurus - pengurus
        // Route::get('/pengurus', [DashboardController::class, 'pengurus']);
        Route::livewire('/pengurus', 'pages::dashboards.pengurus');

        // view detail user yang menhapus akunnya sendiri
        Route::get('/akun-dihapus/{id}', [HapusAkunController::class, 'detail']);

        // laporan - pengurus
        // Route::get('/laporan', [ReportController::class, 'index']);
        Route::livewire('/laporan', 'pages::dashboards.reports');

        // simpan perubahan pada data laporan -> di middleware pengurusKepala (atas)
        Route::put('/laporan/{id}/tindaklanjut', [ReportController::class, 'tindaklanjut']);

        // halaman statistik
        Route::get('/statistik', [StatistikController::class, 'index']);
        // Route::livewire('/statistik', 'pages::dashboards.stats');
    });

    // hanya untuk role kepala
    Route::middleware(['kepala'])->group(function () {
        // level - kepala
        Route::get('/level', [LevelController::class, 'index']);
        // tambah level - kepala
        Route::post('/level/tambah', [LevelController::class, 'create']);
        // update level - kepala
        Route::put('/level/update', [LevelController::class, 'update']);
        // update poin kontribusi - kepala
        Route::put('/poin-kontribusi/update', [PoinKontribusiController::class, 'update']);

        // tambah achievement
        // Route::get('/achievement/baru', [AchievementController::class, 'tambah']);
        Route::livewire('/achievement/baru', 'pages::dashboards.achievement-new');
        // simpan achievement baru
        // Route::post('/achievement/baru', [AchievementController::class, 'save']);
        // edit achievement
        // Route::get('achievement/{id}/edit', [AchievementController::class, 'edit']);
        Route::livewire('/achievement/{id}/edit', 'pages::dashboards.achievement-edit');
        // simpan edit achievement
        // Route::put('/achievement/{id}/edit', [AchievementController::class, 'simpanEdit']);

        // ubah status user sebagai pengurus/kontributor
        Route::put('/ubah-role/{id}', [UserController::class, 'ubahStatusPengurus']);
    });

    // hanya untuk role pengurus
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

        // simpan perubahan pada data laporan -> di middleware pengurusKepala (atas)

        // simpan hukuman yang diberikan
        // Route::post('/laporan/{id}/hukuman', [HukumanController::class, 'tindaklanjut']);

        // setujui edit kosakata
        // Route::put('/kosakata/{slug}/riwayat/{id}/setujui', [EditKosakataController::class, 'setujui']);

        // verifikasi definisi
        // Route::put('/definisi/verifikasi/{kosakata_slug}/{id}', [DefinisiController::class, 'verifikasi']);
    });

    // Pengaturan
    // Route::get('/pengaturan', [DashboardController::class, 'settings']);
    Route::livewire('/pengaturan', 'pages::dashboards.settings');

    // Ubah data diri
    // Route::get('/pengaturan/edit-user', [UserController::class, 'editUser']);
    Route::livewire('/pengaturan/edit-user', 'pages::dashboards.setting-user-info');
    // Simpan perubahan data diri
    // Route::put('/pengaturan/edit-user', [UserController::class, 'update']);

    // ubah tautan dan media sosial
    // Route::get('/pengaturan/tautan', [UserController::class, 'tautan']);
    // Route::put('/pengaturan/tautan/simpan', [UserController::class, 'simpanTautan']);
    Route::livewire('/pengaturan/tautan', 'pages::dashboards.setting-media-social');


    // Simpan edit email
    // Route::put('/pengaturan/ganti-email', [UserController::class, 'updateEmail']);

    // sembunyikan data sensitif
    // Route::get('/pengaturan/data-sensitif', [UserController::class, 'dataSensitif']);
    // Route::put('/pengaturan/data-sensitif/simpan', [UserController::class, 'simpanDataSensitif']);
    Route::livewire('/pengaturan/data-sensitif', 'pages::dashboards.setting-sensitive-info');

    // terima donasi
    // Route::get('/pengaturan/donasi', [UserController::class, 'userDonasi']);
    // Route::put('/pengaturan/donasi/simpan', [UserController::class, 'simpanUserDonasi']);
    Route::livewire('/pengaturan/donasi', 'pages::dashboards.setting-donasi');

    // ubah username
    Route::get('/pengaturan/ubah-username', [UserController::class, 'ubahUsername']);
    Route::put('/pengaturan/ubah-username/simpan', [UserController::class, 'simpanUbahUsername']);

    // ubah alamat email
    Route::get('/pengaturan/ubah-email', [UserController::class, 'ubahEmail']);
    Route::put('/pengaturan/ubah-email/simpan', [UserController::class, 'simpanUbahEmail']);

    // ubah password
    Route::get('/pengaturan/ubah-password', [UserController::class, 'ubahPassword']);
    Route::put('/pengaturan/ubah-password/simpan', [UserController::class, 'updatePassword']);

    // hapus akun
    Route::get('/pengaturan/hapus-akun', [HapusAkunController::class, 'index'])->middleware('kontributorPengurus');
    Route::put('/pengaturan/hapus-akun/konfirmasi', [HapusAkunController::class, 'hapusAkun'])->middleware('kontributorPengurus');

    // Tambah definisi - hanya kontributor dan pengurus
    Route::post('/kosakata/{slug}/buat-definisi', [DefinisiController::class, 'create'])->middleware('kontributorPengurus');
    // Edit definisi - hanya kontributor dan pengurus
    Route::put('/kosakata/{slug}/{definisiId}/update', [DefinisiController::class, 'update'])->middleware('kontributorPengurus');
    // Hapus definisi - hanya kontributor dan pengurus
    Route::delete('/kosakata/{slug}/{definisiId}/delete', [DefinisiController::class, 'delete'])->middleware('kontributorPengurus');
    // edit definisi -livewire
    Route::livewire('definisi/{id}/edit', 'pages::homepages.definition-edit');

    // tambah kosakata - hanya bisa diakses pengurus dan kontributor
    Route::get('/tambah/kosakata', [KosakataController::class, 'tambahKosakata'])->middleware('kontributorPengurus');
    // simpan kosakata baru - hanya bisa diakses pengurus dan kontributor
    Route::post('/tambah/kosakata', [KosakataController::class, 'store'])->middleware('kontributorPengurus');

    // Edit kosakata - hanya bisa diakses pengurus dan kontributor
    Route::get('/kosakata/{slug}/edit', [EditKosakataController::class, 'edit'])->middleware('kontributorPengurus');
    Route::post('/kosakata/{slug}/edit', [EditKosakataController::class, 'simpanEdit'])->middleware('kontributorPengurus');

    // notifikasi
    // Route::get('/notifikasi', [NotifikasiController::class, 'index']);
    Route::livewire('/notifikasi', 'pages::dashboards.notification');
});
