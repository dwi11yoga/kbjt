<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Level;
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
        ], 403);
    }

    // cek apakah dapat achievement/tidak
    public function achievement(int $userId, string $rule, int $value)
    {
        $didapat = User::where('id', '=', $userId)->value('achievement');
        $data = Achievement::where('rule', '=', $rule)->whereNotIn('id', array_keys($didapat))->get();

        // perulangan terhadap achievement yang belum didapatkan
        $simpan = $didapat;
        foreach ($data as $d) {
            if ($value >= $d->requirement) {
                $simpan[$d->id] = Carbon::now();
            }
        }

        // simpan data
        if ($didapat != $simpan) {
            User::find(Auth::user()->id)->update([
                'achievement' => $simpan
            ]);
        }

        // buat notifikasi - belum
        return true;
    }
}
