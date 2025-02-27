<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Definisi;
use App\Models\EditKosakata;
use App\Models\Kosakata;
use App\Models\Level;
use App\Models\Report;
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
        // Kosakata
        $data['kosakata'] = Kosakata::where('user_id', '=', Auth::user()->id);
        $statistik['kosakataTotal'] = (clone $data['kosakata'])->count(); //kosakata total
        $statistik['kosakataBln'] = (clone $data['kosakata'])->whereMonth('created_at', '=', Carbon::now()->month)->count();
        $data['kosakata'] = $data['kosakata']->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'kosakata-page')
            ->onEachSide(2)
            ->appends(request()->query());
        // tambah edit kosakata

        // definisi
        $data['definisi'] = Definisi::select('id', 'kosakata_id', 'user_id', 'poin', 'definisi', 'verifikasi', 'updated_at')
            ->with('kosakata:id,kosakata,slug')
            ->where('user_id', '=', Auth::user()->id);
        $statistik['definisiTotal'] = $data['definisi']->count();
        $statistik['definisiBln'] = $data['definisi']->whereMonth('updated_at', '=', Carbon::now()->month)->count();
        $data['definisi'] = $data['definisi']->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'definisi-page')
            ->onEachSide(2)
            ->appends(request()->query());

        // laporan
        $data['laporan'] = Report::select('id', 'user_id', 'definisi_id', 'alasan', 'status', 'updated_at')
            ->with('definisi:id,kosakata_id')
            ->where('user_id', '=', Auth::user()->id);
        $statistik['laporanPending'] = (clone $data['laporan'])->whereNull('status')->count(); //pakai "clone" agar query  didalam $data['laporan'] tidak berubah
        $statistik['laporanTotal'] = $data['laporan']->count();

        if (isset($_REQUEST['filter_laporan']) && $_REQUEST['filter_laporan'] == 'Pending') {
            $data['laporan'] = $data['laporan']->whereNull('status');
        } elseif (isset($_REQUEST['filter_laporan']) && $_REQUEST['filter_laporan'] == 'Ditangani') {
            $data['laporan'] = $data['laporan']->whereNotNull('status');
        }

        $data['laporan'] = $data['laporan']->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'report-page')
            ->onEachSide(2)
            ->appends(request()->query());
        foreach ($data['laporan'] as $d) {
            $d['kosakata'] = Kosakata::select('id', 'kosakata')
                ->where('id', '=', $d->definisi->kosakata_id)
                ->value('kosakata');
        }

        return view('dashboard.kontribusi', [
            'group' => 'kontribusi',
            'title' => 'Kontribusi',
            'statistik' => $statistik,
            'data' => $data,
            'query' => request()->query() // Menyertakan semua parameter di URL
        ]);
    }

    // view halaman kontributor
    public function kontributor()
    {

        // overview
        $overview['kontributor'] = number_format(User::where('role', '=', 'kontributor')->count('id'), 0, ',', '.');
        $overview['kontributorBlnIni'] = User::where('role', '=', 'kontributor')->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count('id');

        $definisi = Definisi::whereMonth('created_at', '=', Carbon::now()->month)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $kosakata = Kosakata::whereMonth('created_at', '=', Carbon::now()->month)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $editkosakata = EditKosakata::whereMonth('created_at', '=', Carbon::now()->month)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $laporan = Report::whereMonth('created_at', '=', Carbon::now()->month)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $overview['kontribusi'] = $definisi + $kosakata + $editkosakata + $laporan;

        $definisi = Definisi::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $kosakata = Kosakata::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $editkosakata = EditKosakata::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $laporan = Report::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $overview['kontribusiBlnKemarin'] = $definisi + $kosakata + $editkosakata + $laporan;

        // data kontributor
        $kontributor = User::where('role', '=', 'kontributor')
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'kontributor')
            ->onEachSide(2)
            ->appends(request()->query());
        foreach ($kontributor as $d) {
            // level
            $d['level'] = $this->levelCalculator($d->poin);
            // kontribusi total
            $definisi = Definisi::where('user_id', '=', $d->id)->count();
            $kosakata = Kosakata::where('user_id', '=', $d->id)->count();
            $editkosakata = EditKosakata::where('user_id', '=', $d->id)->count();
            $laporan = Report::where('user_id', '=', $d->id)->count();
            $d['kontribusiTotal'] = $definisi + $kosakata + $editkosakata + $laporan;
            // kontribusi bulan ini
            $definisi = Definisi::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->count();
            $kosakata = Kosakata::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->count();
            $editkosakata = EditKosakata::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->count();
            $laporan = Report::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->count();
            $d['kontribusiBlnIni'] = $definisi + $kosakata + $editkosakata + $laporan;
        }

        // data kosakata & definisi baru
        $kosakata = Kosakata::whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'kosakata')
            ->onEachSide(2)
            ->appends(request()->query());
        $definisi = Definisi::whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })
            ->with('kosakata:id,kosakata,slug')
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'definisi')
            ->onEachSide(2)
            ->appends(request()->query());

        // dd($definisi);

        return view('dashboard.kontributor', [
            'title' => 'Kontributor',
            'group' => 'kontributor',
            'overview' => $overview,
            'kontributor' => $kontributor,
            'kosakata' => $kosakata,
            'definisi' => $definisi
        ]);
    }

    // view halaman pengurus
    public function pengurus()
    {
        // jumlah pengurus
        $overview['jmlPengurus'] = User::where('role', '=', 'pengurus')->count();
        $overview['jmlUser'] = User::count();
        $overview['rasioUser'] = number_format($overview['jmlPengurus'] / $overview['jmlUser'] * 10, 1, ',');

        // kontributsi pengurus bulan ini
        $kosakata = Kosakata::whereMonth('created_at', '=', Carbon::now()->month)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $definisi = Definisi::whereMonth('created_at', '=', Carbon::now()->month)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $editkosakata = EditKosakata::whereMonth('created_at', '=', Carbon::now()->month)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $laporan = Report::whereNotNull('status')->whereMonth('status', '=', Carbon::now()->month)->count();
        $blog = Blog::whereNotNull('status')->whereMonth('status', '=', Carbon::now()->month)->count();
        // kurang banner
        $overview['kontribusiBlnIni'] = $kosakata + $definisi + $editkosakata + $laporan + $blog;

        // kontributsi pengurus bulan lalu
        $kosakata = Kosakata::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $definisi = Definisi::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $editkosakata = EditKosakata::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $laporan = Report::whereNotNull('status')->whereMonth('status', '=', Carbon::now()->subMonth()->month)->count();
        $blog = Blog::whereNotNull('status')->whereMonth('status', '=', Carbon::now()->subMonth()->month)->count();
        // kurang banner
        $overview['kontribusiBlnKmrn'] = $kosakata + $definisi + $editkosakata + $laporan + $blog;

        // data pengurus
        $pengurus = User::where('role', '=', 'pengurus')
            ->orderBy('poin', 'desc')
            ->paginate(10, '*', 'pengurus')
            ->onEachSide(2)
            ->appends(request()->query());
        foreach ($pengurus as $d) {
            // level
            $d['level'] = $this->levelCalculator($d->poin);
            // kontribusi total
            $definisi = Definisi::where('user_id', '=', $d->id)->count();
            $kosakata = Kosakata::where('user_id', '=', $d->id)->count();
            $editkosakata = EditKosakata::where('user_id', '=', $d->id)->count();
            $laporan = Report::where('pengurus_id', '=', $d->id)->count();
            $blog = Blog::whereNotNull('status')->where('user_id', '=', $d->id)->count();
            $d['kontribusiTotal'] = $definisi + $kosakata + $editkosakata + $laporan + $blog;
            // kontribusi bulan ini
            $definisi = Definisi::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->count();
            $kosakata = Kosakata::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->count();
            $editkosakata = EditKosakata::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->count();
            $laporan = Report::where('pengurus_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->count();
            $blog = Blog::whereNotNull('status')->where('user_id', '=', $d->id)->whereMonth('status', '=', Carbon::now()->month)->count();
            $d['kontribusiBlnIni'] = $definisi + $kosakata + $editkosakata + $laporan + $blog;
        }

        // data kosakata & definisi baru
        $kosakata = Kosakata::whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'kosakata')
            ->onEachSide(2)
            ->appends(request()->query());
        $definisi = Definisi::whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })
            ->with('kosakata:id,kosakata,slug')
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'definisi')
            ->onEachSide(2)
            ->appends(request()->query());

        $editKosakata = EditKosakata::whereNotNull('pengurus_id')
            ->with('kosakata:id,kosakata,slug')
            ->with('user:id,username,nama,jenis_kelamin,profile_pic')
            ->with('pengurus:id,username,nama,jenis_kelamin,profile_pic')
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'edit-kosakata')
            ->onEachSide(2)
            ->appends(request()->query());

        // dd($overview);

        return view('dashboard.pengurus', [
            'title' => 'Pengurus',
            'group' => 'pengurus',
            'overview' => $overview,
            'pengurus' => $pengurus,
            'kosakata' => $kosakata,
            'definisi' => $definisi,
            'editKosakata' => $editKosakata
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
