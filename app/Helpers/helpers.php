<?php

use App\Models\Level;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Achievement;
use App\Models\Definisi;
use App\Models\Blog;
use App\Models\Hukuman;
use App\Models\Report;
use App\Models\Notifikasi;
use App\Models\PoinKontribusi;
use App\Models\Sertifikat;
use App\Models\Statistik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;


// Hitung level pengguna
if (!function_exists('levelCalculator')) {
    function levelCalculator(int $point)
    {
        $levelSets = Level::select(['lvl', 'min_poin'])->orderBy('lvl', 'desc')->get();
        foreach ($levelSets as $d) {
            if ($point >= $d->min_poin) {
                return $d->lvl;
            }
        }
    }
}

// dapatkan url web saat ini
if (!function_exists('getUrl')) {
    function getUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https:' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $url = $protocol . '://' . $host;
        return $url;
    }
}

// format tanggal
if (!function_exists('dateFormat')) {
    function dateFormat($datetime)
    {
        $date = Carbon::create($datetime);
        // dd(floor($date->diffInDays()) == 5);
        if ($date->isToday()) {
            $date = 'Hari ini';
        } elseif (floor($date->diffInDays()) == 1) {
            $date = 'Kemarin';
        } elseif (floor($date->diffInDays()) == 2) {
            $date = 'Lusa';
        } elseif (floor($date->diffInDays()) <= 7) {
            $date = floor($date->diffInDays()) . ' hari lalu';
        } else {
            $date = $date->format('j M Y');
        }
        return $date;
    }
}

// cek ahcievement user
if (!function_exists('achievement')) {
    function achievement(int $userId, string $rule)
    {
        // cek dulu apakah akun user sudah dihapus. jika dihapus, maka tidak perlu melakukan pengecekan achievement
        $user = User::withTrashed()->find($userId);

        // jika akun user dihapus / kepala, maka tidak perlu dilanjutkan
        if ($user->trashed() == true || $user->role == 'kepala') {
            return;
        }

        $rules = [
            'keanggotaan',
            'definisi',
            'laporan',
            'artikel',
            'totalViewBlog',
            'viewBlog'
        ];
        // jika rule yang diberikan tidak sesuai, maka tidak perlu dilanjut
        if (!in_array($rule, $rules)) {
            return;
        }

        // dapatkan achievement dan role user yang didapatkkan
        $achievements = Achievement::where('rule', $rule)
            ->whereNotIn('id', array_keys($user?->achievement ?? [])); // ?-> null-safe: agar tidak error ketika variabel==null

        // cek apakah user adalah pengurus atau tidak, agar kontributor tidak bisa mendapatkan achievement pengurus
        if ($user->role != 'pengurus') {
            // pengurus
            $achievements = $achievements->orderBy('requirement', 'asc')
                ->get();
        } else {
            // bukan
            $achievements = $achievements->whereNot('role', 'pengurus')
                ->orderBy('requirement', 'asc')
                ->get();
        }

        // cek jumlah kontribusi user
        switch ($rule) {
            case "keanggotaan":
                $value = round($user->created_at->diffInDays(now())) ?? 0;
                break;
            case "definisi":
                $value = Definisi::where('user_id', '=', $userId)->count() ?? 0;
                break;
            case "laporan":
                $value = Report::where('user_id', '=', $userId)->whereNotNull('status')->count() ?? 0;
                break;
            case "artikel":
                $value = Blog::where('user_id', '=', $userId)->whereNotNull('status')->count() ?? 0;
                break;
            case "totalViewBlog":
                $value = Blog::where('user_id', '=', $userId)->sum('view') ?? 0;
                break;
            case "viewBlog":
                $value = Blog::where('user_id', '=', $userId)->orderBy('view', 'desc')->value('view') ?? 0;
                break;
            default:
                $value = 0;
                break;
        }


        // perulangan terhadap achievement yang belum didapatkan. jika memenuhi achievement, maka simpan data baru
        $simpan = $user->achievement;
        $poin = 0;
        foreach ($achievements as $d) {
            // jika value lebih kecil dari requirement (artinya tidak sesuai dengan requirement)
            if ($value < $d->requirement) {
                break;
            }
            // jika value lebih besar dari requirement (artinya sesuai dengan requirement)
            $simpan[$d->id] = now();
            $poin = $poin + $d->reward;

            // simpan data di tabel notifikasi
            $pesan = 'Kamu berhasil mendapatkan achievement ' . $d->nama . '! (+' . $d->reward . ' poin)';
            $url = '/achievement';
            createNotification($userId, 'achievement', $pesan, $url);
        }

        // jika tidak ada data achievement yang berubah (tidak ada achievement baru)
        if ($user->achievement == $simpan) {
            return;
        }

        // simpan data
        User::find($userId)->update([
            'achievement' => $simpan
        ]);

        // tambah poin exp
        User::find($userId)->increment('poin', $poin);
    }
}

// cek sertifikat
if (!function_exists('cekSertifikat')) {
    function cekSertifikat(int $userId)
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
            if ($d->rule == 'keanggotaan') {
                // hitung lama user terdaftar
                $nilai = Auth::user()->created_at->diffInDays(now());
            } elseif ($d->rule == 'kontribusi') {
                // hitung kontribusi user
                $definisi = Definisi::where('user_id', Auth::user()->id)->count();
                $laporan = Report::where('user_id', Auth::user()->id)->whereNotNull('status')->whereNotNull('pengurus_id')->count();
                $nilai = $definisi + $laporan;
            } elseif ($d->rule == 'kontribusiPengurus') {
                // hitung kontribusi user pengurus
                $definisi = Definisi::where('verifikasi_oleh', Auth::user()->id)->count();
                $laporan = Report::where('pengurus_id', Auth::user()->id)->whereNotNull('status')->count();
                // banner - BELOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOM
                $banner = 0;
                $blog = Blog::where('user_id', Auth::user()->id)->whereNotNull('status')->count();
                $nilai = $definisi + $laporan + $blog + $banner;
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
                createNotification($userId, 'sertifikat', $pesan, $url);
            }
        }
    }
}

// buat notifikasi (nama sebelumnya: kirimNotifikasi)
if (!function_exists('createNotification')) {
    function createNotification(int $penerimaNotif, string $kategori, string $pesan, string $url)
    {
        Notifikasi::create([
            'user_id' => $penerimaNotif,
            'kategori' => $kategori ?? null,
            'message' => $pesan,
            'url' => $url ?? null,
        ]);

        return "success";
    }
}

// cekSuspend akun
if (!function_exists('suspendedAccount')) {
    function suspendedAccount()
    {
        // cek apakah user tersuspend/tidak
        $suspendedTime = Auth::user()->suspended_time;

        if (!empty($suspendedTime) && Carbon::now()->isBefore($suspendedTime)) {
            // jika tersuspend
            $result = true;
        } else {
            // hapus waktu suspend dari database
            if (!empty($suspendedTime)) {
                User::find(Auth::user()->id)->update(['suspended_time' => null]);
            }
            $result = false;
        }
        return $result;
    }
}

// tambah poin pengguna (nama sebelumnya: poinKontribusi)
if (!function_exists('addPoint')) {
    function addPoint(int $userId, string $contributionType)
    {
        // cek apakah pengguna ada di database
        $user = User::find($userId);
        if (!isset($user)) {
            return 0;
        }

        // cek jumlah poin yang ditambahkan
        $poin = PoinKontribusi::where('role', $user->role)
            ->where('kontribusi', $contributionType)
            ->first()
            ->poin ?? 0; // jika null, maka nilai poin adalah 0

        // tambah poin user jika lebih dari 0
        if ($poin > 0) {
            $user->increment('poin', $poin);
        }

        return $poin;
    }
}

// tambah data statistik (nama sebelumnya: stat dan statDecrement)
if (!function_exists('changeStat')) {
    function changeStat(string $columnName, bool $isIncrement = true)
    {
        // cek apakah sudah ada data untuk tahun dan bulan ini/belum
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;
        $cek = Statistik::where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->first();

        // kalau tidak ada, buat data
        if (empty($cek)) {
            Statistik::create([
                'tahun' => $tahun,
                'bulan' => $bulan
            ]);
        }

        // increment/decrement data
        $data = Statistik::where('tahun', $tahun)
            ->where('bulan', $bulan);

        if ($isIncrement == true) {
            $data->increment($columnName, 1);
        } else {
            $data->decrement($columnName, 1);
        }
    }
}
