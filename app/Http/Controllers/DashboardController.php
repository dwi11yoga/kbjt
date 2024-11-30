<?php

namespace App\Http\Controllers;

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
        $lengkap = true;
        $field = ['tgl_lahir', 'kota', 'jenis_kelamin', 'profile_pic', 'bio', 'telp'];
        $user = DB::table('users')->where('id', Auth::user()->id)->get($field)->first();
        if ($user->tgl_lahir === null || $user->kota === null || $user->jenis_kelamin === null || $user->kota === null || $user->kota === null || $user->kota === null) {
            $lengkap = false;
        }

        return view('dashboard.index', [
            'group' => 'dashboard',
            'title' => 'Dashboard',
            'lengkap' => $lengkap,
            'userProgress' => $userProgress
        ]);
    }

    public function kontribusi()
    {
        return view('dashboard.kontribusi', [
            'group' => 'kontribusi',
            'title' => 'Kontribusi'
        ]);
    }
    public function achivement()
    {
        return view('dashboard.achivement', [
            'group' => 'achivement',
            'title' => 'Achivement'
        ]);
    }
    public function sertifikat()
    {
        return view('dashboard.sertifikat', [
            'group' => 'sertifikat',
            'title' => 'Sertifikat'
        ]);
    }

    public function settings()
    {
        return view('dashboard.settings', [
            'group' => 'settings',
            'title' => 'Pengaturan',
        ]);
    }
}
