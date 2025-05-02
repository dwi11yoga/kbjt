<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Definisi;
use App\Models\EditKosakata;
use App\Models\HapusAkun;
use App\Models\Kosakata;
use App\Models\Level;
use App\Models\Notifikasi;
use App\Models\PoinKontribusi;
use App\Models\Report;
use App\Models\Sertifikat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    // Untuk menghitung level
    public function levelCalculator($point)
    {
        $levelSets = Level::select(['lvl', 'min_poin'])->orderBy('lvl', 'desc')->get();
        foreach ($levelSets as $d) {
            if ($point >= $d->min_poin) {
                return $d->lvl;
            }
        }
    }

    // Untuk mengetahui progress user
    public function progressCalculator($point)
    {
        $level = $this->levelCalculator($point);
        $levelSets = Level::select(['lvl', 'min_poin'])->orderBy('lvl', 'desc')->get();

        $syaratNaikLvl = $levelSets->firstWhere('lvl', $level + 1)?->min_poin; // ? untuk agar ketika null tidak error
        $minPoin = $levelSets->firstWhere('lvl', $level)->min_poin;
        if ($syaratNaikLvl == null) {
            return 100;
        } else {
            return intval((($point - $minPoin) / ($syaratNaikLvl - $minPoin)) * 100);
        }
    }

    // untuk menghitung persentase
    public function persentase($nilai, $total)
    {
        $hasil = round(($nilai / $total) * 100) . '%';
        return $hasil;
    }

    // mengetahui url web
    public function getUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https:' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $url = $protocol . '://' . $host;
        return $url;
    }

    // untuk menampilkan error 403: unathorized access
    public function error403()
    {
        return response()->view('error.403', [
            'title' => 'Akses ditolak'
        ], 403);
    }

    // untuk menampilkan error 404: not found
    public function error404()
    {
        return response()->view('error.404', [
            'title' => 'Halaman tidak ditemukan'
        ], 404);
    }

    // cek apakah user dapat achievement/tidak
    public function achievement(int $userId, string $rule)
    {
        // cek dulu apakah akun user sudah dihapus. jika dihapus, maka tidak perlu melakukan pengecekan achievement
        $apakahDihapus = User::withTrashed()->find($userId)->trashed(); // true=dihapus:false=tidak dihapus

        if ($apakahDihapus == false) { // jika akun user tidak dihapus, maka eksekusi kode berikut
            $user = User::where('id', '=', $userId)->first(); // dapatkan achievement dan role user yang didapatkkan
            $data = Achievement::where('rule', '=', $rule)
                ->whereNotIn('id', array_keys($user?->achievement ?? [])); // ?-> null-safe: agar tidak error ketika variabel==null

            // cek apakah user adalah pengurus atau tidak, agar kontributor tidak bisa mendapatkan achievement pengurus
            if ($user->role != 'pengurus') {
                $data = $data->orderBy('requirement', 'asc')
                    ->get();
            } else {
                $data = $data->whereNot('rule', 'pengurus')
                    ->orderBy('requirement', 'asc')
                    ->get();
            }

            // cek jumlah kontribusi user
            if ($rule == 'keanggotaan') {
                // cek lama suer bergabung
                $value = round($user->created_at->diffInDays(now())) ?? 0;
            } elseif ($rule == 'definisi') {
                // cek jumlah definisi yang dibuat oleh user
                $value = Definisi::where('user_id', '=', $userId)->count() ?? 0;
            } elseif ($rule == 'kosakata') {
                // cek jumlah kosakata yang dibuat oleh user
                $value = Kosakata::where('user_id', '=', $userId)->count() ?? 0;
            } elseif ($rule == 'editKosakata') {
                // cek jumlah kosakata yang diedit oleh user (dan di acc oleh pengurus)
                $value = EditKosakata::where('user_id', '=', $userId)->whereNotNull('status')->count() ?? 0;
            } elseif ($rule == 'laporan') {
                // cek jumlah laporan yang dibuat oleh user dan diacc oleh pengurus
                $value = Report::where('user_id', '=', $userId)->whereNotNull('status')->count() ?? 0;
            } elseif ($rule == 'artikel') {
                // cek jumlah artikel yang dibuat oleh user dan dipublikasikan
                $value = Blog::where('user_id', '=', $userId)->whereNotNull('status')->count() ?? 0;
            } elseif ($rule == 'totalViewKosakata') {
                // cek jumlah view dari semua kosakata yang dibuat oleh user
                $value = Kosakata::where('user_id', '=', $userId)->sum('view') ?? 0;
            } elseif ($rule == 'viewKosakata') {
                // cek jumlah view dari 1 kosakata paling banyak dilihat yang dibuat oleh user
                $value = Kosakata::where('user_id', '=', $userId)->orderBy('view', 'desc')->value('view') ?? 0;
            } elseif ($rule == 'totalViewBlog') {
                // cek jumlah view dari semua artikel yang dibuat oleh user
                $value = Blog::where('user_id', '=', $userId)->sum('view') ?? 0;
            } elseif ($rule == 'viewBlog') {
                // cek jumlah view dari 1 artikel paling banyak dilihat yang dibuat oleh user
                $value = Blog::where('user_id', '=', $userId)->orderBy('view', 'desc')->value('view') ?? 0;
            } else {
                $value = 0;
            }

            // perulangan terhadap achievement yang belum didapatkan. jika memenuhi achievement, maka simpan data baru
            $simpan = $user->achievement;
            $poin = 0;
            foreach ($data as $d) {
                if ($value >= $d->requirement) { // jika value lebih besar dari requirement...
                    $simpan[$d->id] = now();
                    $poin = $poin + $d->reward;

                    // simpan data di tabel notifikasi
                    $pesan = 'Kamu berhasil mendapatkan achievement ' . $d->nama . ' 🎉';
                    $url = '/achievement';
                    $this->kirimNotifikasi($userId, 'achievement', $pesan, $url);

                } else { // jika $value tidak lebih besar dari requirement terkecil, maka hentikan function
                    break;
                }
            }

            if ($user->achievement != $simpan) {
                // simpan data
                User::find($userId)->update([
                    'achievement' => $simpan
                ]);

                // tambah poin exp
                User::find($userId)->increment('poin', $poin);
            }
        }

        return true;
    }

    // hitung requirement sertifikat
    public function hitungRequirementSertifikat(string $rule, int $userId)
    {
        if ($rule == 'keanggotaan') { // hitung lama user terdaftar
            $nilai = User::where('id', $userId)->value('created_at')->diffInDays(now());
        } elseif ($rule == 'kontribusi') { // hitung kontribusi user
            $kosakata = Kosakata::where('user_id', $userId)->count();
            $editKosakata = EditKosakata::where('user_id', $userId)->whereNotNull('status')->count();
            $definisi = Definisi::where('user_id', $userId)->count();
            $laporan = Report::with('hukuman')->where('user_id', $userId)->whereNotNull('status')->whereHas('hukuman')->count();
            $nilai = $kosakata + $editKosakata + $definisi + $laporan;
        } elseif ($rule == 'kontribusiPengurus') { // hitung kontribusi user sebagai pengurus
            $editKosakata = EditKosakata::where('pengurus_id', $userId)->whereNotNull('status')->count();
            $definisi = Definisi::where('verifikasi_oleh', $userId)->count();
            $laporan = Report::where('pengurus_id', $userId)->whereNotNull('status')->count();
            // banner - belom
            $blog = Blog::where('user_id', $userId)->whereNotNull('status')->count();
            $nilai = $editKosakata + $definisi + $laporan + $blog;
        } else {
            $nilai = 0;
        }

        return $nilai;
    }

    // fungsi untuk mengambil data banner
    function getBanner(array $id)
    {
        // dapatkan data banner -> ubah jadi array
        $banner = Banner::all()->keyBy('id')->toArray();

        // hanya ambil banner yang dibutuhkan
        $showBanner = [];
        foreach ($id as $d) {
            $showBanner[$d] = $banner[$d];
        }

        // kembalikan nilai $showbanner
        return $showBanner;
    }

    // fungsi mengirim notifikasi ke user
    public function kirimNotifikasi(int $penerimaNotif, string $kategori, string $pesan, string $url)
    {
        Notifikasi::create([
            'user_id' => $penerimaNotif,
            'kategori' => $kategori ?? null,
            'message' => $pesan,
            'url' => $url ?? null,
        ]);

        return "sukses";
    }

    // cek apakah user mendapat notifikasi
    public function cekNotifikasi(int $userId)
    {
        // dapatkan data
        $notif = Notifikasi::where('user_id', $userId)
            ->whereNot('dilihat', 1)
            ->first();

        // jika $notif kosong, maka semua notifikasi sudah dibaca
        $adaNotif = isset($notif) ? 1 : 0; // 1= ada notifikasi

        return $adaNotif;
    }

    // buat notifikasi jika user dapat mengklaim sertifikat
    public function cekSertifikat(int $userId)
    {
        // dapatkan data sertifikat yang didapat user
        $user = User::find($userId);

        // dapatkan semua data sertifikat (kecuali yang sudah didapat)
        if ($user->role == 'pengurus') {
            $sertifikat = Sertifikat::whereNotIn('id', array_keys($user?->sertifikat ?? [])) // ?-> null-safe: agar tidak error ketika variabel==null
                ->whereNull('role')
                ->orWhere('role', 'pengurus');
        } else {
            $sertifikat = Sertifikat::whereNotIn('id', array_keys($user?->sertifikat ?? [])) // ?-> null-safe: agar tidak error ketika variabel==null
                ->whereNull('role');
        }
        $sertifikat = $sertifikat->orderBy('rule', 'asc')->orderBy('requirement', 'asc')->get();

        // cek apakah user sudah bisa meng-klaim sertifikat
        foreach ($sertifikat as $d) {
            // cek progress user dalam mendapatkan sertifikat
            if ($d->rule == 'keanggotaan') { // hitung lama user terdaftar
                $nilai = Auth::user()->created_at->diffInDays(now());
            } elseif ($d->rule == 'kontribusi') { // hitung kontribusi user
                $kosakata = Kosakata::where('user_id', Auth::user()->id)->count();
                $editKosakata = EditKosakata::where('user_id', Auth::user()->id)->whereNotNull('status')->count();
                $definisi = Definisi::where('user_id', Auth::user()->id)->count();
                $laporan = Report::with('hukuman')->where('user_id', Auth::user()->id)->whereNotNull('status')->whereHas('hukuman')->count();
                $nilai = $kosakata + $editKosakata + $definisi + $laporan;
            } elseif ($d->rule == 'kontribusiPengurus') { // hitung kontribusi user pengurus
                $editKosakata = EditKosakata::where('pengurus_id', Auth::user()->id)->whereNotNull('status')->count();
                $definisi = Definisi::where('verifikasi_oleh', Auth::user()->id)->count();
                $laporan = Report::where('pengurus_id', Auth::user()->id)->whereNotNull('status')->count();
                // banner - belom
                $banner = 0;
                $blog = Blog::where('user_id', Auth::user()->id)->whereNotNull('status')->count();
                $nilai = $editKosakata + $definisi + $laporan + $blog + $banner;
            } else {
                $nilai = 0;
            }

            // jika kontribusi lebih besar dari requirement && user belum mendapatkan notifikasi..
            $pesan = 'Kamu berhak untuk meng-klaim sertifikat karena ' . strtolower($d->nama) . ' 🎉';
            $url = '/sertifikat';
            $cekNotifikasi = Notifikasi::where('user_id', $userId)
                ->where('message', $pesan)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($nilai >= $d->requirement && empty($cekNotifikasi) == true) {
                // kirim notifikasi
                $this->kirimNotifikasi($userId, 'sertifikat', $pesan, $url);
            }
        }

        return 'selesai :)';
    }

    // tambahkan poin atas kontribusi
    public function poinKontribusi(int $userId, string $kontribusi)
    {

        // dapatkan role user
        $role = User::find($userId)->role;
        // dapatkan poin reward untuk user
        $poin = PoinKontribusi::where('role', $role)
            ->where('kontribusi', $kontribusi)
            ->first()
            ->poin ?? 0; // jika null, maka nilai poin adalah 0

        // tambah poin user
        User::find($userId)->increment('poin', $poin);

        return $poin;
    }
}
