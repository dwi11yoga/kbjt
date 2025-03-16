<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Definisi;
use App\Models\EditKosakata;
use App\Models\Kosakata;
use App\Models\Level;
use App\Models\Report;
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

    // cek apakah dapat achievement/tidak
    public function achievement(int $userId, string $rule, int $value)
    {
        $didapat = User::where('id', '=', $userId)->value('achievement');
        $data = Achievement::where('rule', '=', $rule)
            ->whereNotIn('id', array_keys(is_array($didapat) ? $didapat : []))
            ->orderBy('requirement', 'asc')
            ->get();

        // perulangan terhadap achievement yang belum didapatkan
        $simpan = $didapat;
        $poin = 0;
        foreach ($data as $d) {
            if ($value >= $d->requirement) {
                $simpan[$d->id] = now();
                $poin = $poin + $d->reward;
            } else {
                break;
            }
        }

        if ($didapat != $simpan) {
            // simpan data
            User::find($userId)->update([
                'achievement' => $simpan
            ]);

            // tambah poin exp
            User::find($userId)->increment('poin', $poin);

            // buat notifikasi - belum
        }

        return true;
    }

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
            $banner = 0;
            $blog = Blog::where('user_id', $userId)->whereNotNull('status')->count();
            $nilai = $editKosakata + $definisi + $laporan + $blog + $banner;
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
}
