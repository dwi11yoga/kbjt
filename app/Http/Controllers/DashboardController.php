<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Definisi;
use App\Models\Kosakata;
use App\Models\Level;
use App\Models\User;
use Carbon\Carbon;
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

        $data = [
            'group' => 'dashboard',
            'title' => 'Dashboard',
            'lengkap' => $lengkap,
            'userProgress' => $userProgress
        ];

        // Tampilkan statistik untuk pengurus dan kepala
        if (Auth::user()->role == 'pengurus' || Auth::user()->role == 'kepala') {
            $statistik['anggota'] = number_format(User::count('id'), 0, ',', '.');

            $statistik['anggotaBlnIni'] = User::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count('id');
            $statistik['anggotaBlnIni'] = number_format($statistik['anggotaBlnIni'], 0, ',', '.');

            $statistik['kosakata'] = number_format(Kosakata::count('id'), 0, ',', '.');

            $statistik['kosakataBlnIni'] = Kosakata::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count('id');
            $statistik['kosakataBlnIni'] = number_format($statistik['kosakataBlnIni'], 0, ',', '.');

            $statistik['definisi'] = number_format(Definisi::count('id'), 0, ',', '.');
            $statistik['definisiBlnIni'] = Definisi::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count('id');
            $statistik['definisiBlnIni'] = number_format($statistik['definisiBlnIni'], 0, ',', '.');

            $statistik['post'] = Blog::count('id');
            $statistik['postPublish'] = Blog::where('status', '=', 1)->count('id');


            $statistik['defTerverify'] = Definisi::where('verifikasi', '=', "1")->count('id');
            $data['statistik'] = $statistik;
        }

        // Kontribusi terbaru
        if (Auth::user()->role == 'pengurus' || Auth::user()->role == 'kontributor') {
            $kontribusi = [];
            // definisi by user
            $userDefinisi = Definisi::select('id', 'user_id', 'kosakata_id', 'poin', 'updated_at')
                ->where('user_id', '=', Auth::user()->id)
                ->with('kosakata:id,kosakata')
                ->orderBy('updated_at', 'desc')
                ->limit(5)
                ->get();
            foreach ($userDefinisi as $d) {
                $kontribusi['definisi-' . $d->id] = [
                    'kontribusi' => 'Menambahkan definisi untuk kosakata ' . $d->kosakata->kosakata,
                    'poin' => $d->poin,
                    'waktu' => $d->updated_at
                ];
            }

            // kosakata by user
            $userKosakata = Kosakata::select('id', 'user_id', 'kosakata', 'poin', 'created_at')
                ->where('user_id', '=', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            foreach ($userKosakata as $d) {
                $kontribusi['kosakata-' . $d->id] = [
                    'kontribusi' => 'Menambahkan kosakata ' . $d->kosakata,
                    'poin' => $d->poin,
                    'waktu' => $d->created_at
                ];
            }

            // urutkan berdasarkan waktu
            usort($kontribusi, function ($a, $b) {
                return strtotime($b['waktu']) <=> strtotime($a['waktu']);
            });

            $data['kontribusi'] = array_slice($kontribusi, 0, 5);

            if (Auth::user()->role == 'pengurus') {
                $kontribusiArtikel = Blog::where('user_id', '=', Auth::user()->id)->get();
            }
        }

        return view('dashboard.index', $data);
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
