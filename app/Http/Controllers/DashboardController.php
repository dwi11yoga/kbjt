<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    // Dashboard
    public function index()
    {

        // Hitung Level
        $levelSets = DB::table('levels')->select(['lvl', 'min_poin'])->orderBy('lvl', 'desc')->get();
        function Lvl($levelSets)
        {
            $userPoin = Auth::user()->poin;
            foreach ($levelSets as $levelSet) {
                if ($userPoin >= $levelSet->min_poin) {
                    return $levelSet;
                }
            }
        }
        $hitungLvl = Lvl($levelSets);

        $syaratNaikLvl = $levelSets->firstWhere('lvl', $hitungLvl->lvl + 1)?->min_poin; // ? untuk agar ketika null tidak error
        if ($syaratNaikLvl == null) {
            $userProgress = [
                'lvl' => $hitungLvl->lvl,
                'progress' => 100,
                'poinKurang' => null
            ];
        } else {
            $userProgress = [
                'lvl' => $hitungLvl->lvl,
                'progress' => intval(((Auth::user()->poin - $hitungLvl->min_poin) / ($syaratNaikLvl - $hitungLvl->min_poin)) * 100),
                'poinKurang' => $syaratNaikLvl - Auth::user()->poin
            ];
        }

        // Cek data lengkap/tidak untuk pemberitahuan
        $user = User::select('tgl_lahir', 'kota', 'jenis_kelamin', 'profile_pic', 'bio', 'telp')
            ->where('id', Auth::user()->id)
            ->first();
        $lengkap = empty($user['jenis_kelamin']) || empty($user['tgl_lahir']) ? false : true;

        return view('dashboard.index', [
            'group' => 'dashboard',
            'title' => 'Dashboard',
            'lengkap' => $lengkap,
            'userProgress' => $userProgress
        ]);
    }

    // Kontribusi - Kontributor
    public function kontribusi()
    {
        return view('dashboard.kontribusi', [
            'group' => 'kontribusi',
            'title' => 'Kontribusi'
        ]);
    }

    // HAlaman achievement
    public function achivement()
    {
        return view('dashboard.achivement', [
            'group' => 'achivement',
            'title' => 'Achivement'
        ]);
    }
    // Halaman sertifikat
    public function sertifikat()
    {
        return view('dashboard.sertifikat', [
            'group' => 'sertifikat',
            'title' => 'Sertifikat'
        ]);
    }
    // Halaman setting
    public function settings()
    {
        return view('dashboard.settings', [
            'group' => 'settings',
            'title' => 'Pengaturan',
        ]);
    }
}
