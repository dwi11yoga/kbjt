<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Blog;
use App\Models\Definisi;
use App\Models\EditKosakata;
use App\Models\HapusAkun;
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
        $levelSets = DB::table('levels')
            ->select(['lvl', 'min_poin'])
            ->orderBy('lvl', 'desc') // diurutkan dari level paling tinggi
            ->get();

        // dapatkan level user
        function Lvl($levelSets)
        {
            $userPoin = Auth::user()->poin; // poin user
            foreach ($levelSets as $levelSet) {
                if ($userPoin >= $levelSet->min_poin) {
                    return $levelSet;
                }
            }
        }
        $hitungLvl = $this->levelCalculator(Auth::user()->id);

        $syaratNaikLvl = $levelSets
            ->firstWhere('lvl', $hitungLvl + 1)
                ?->min_poin; // menggunakan null-safe ? untuk agar ketika null tidak error

        if ($syaratNaikLvl == null) {
            $userProgress = [
                'lvl' => $hitungLvl,
                'progress' => 100,
                'poinKurang' => null
            ];
        } else {
            $userProgress = [
                'lvl' => $hitungLvl,
                'progress' => intval(((Auth::user()->poin - $hitungLvl) / ($syaratNaikLvl - $hitungLvl)) * 100),
                'poinKurang' => $syaratNaikLvl - Auth::user()->poin // selisih poin untuk naik level
            ];
        }

        // Cek data lengkap/tidak (untuk pemberitahuan)
        // $user = User::select('tgl_lahir', 'kota', 'jenis_kelamin', 'profile_pic', 'bio', 'telp')
        //     ->where('id', Auth::user()->id)
        //     ->first();
        $user = Auth::user();
        $lengkap = empty($user->jenis_kelamin) || empty($user->tgl_lahir) ? false : true;

        // atur data yang akan dikirim ke view
        $data = [
            'group' => 'dashboard',
            'title' => 'Dashboard',
            'lengkap' => $lengkap,
            'userProgress' => $userProgress
        ];

        // Tampilkan statistik untuk pengurus dan kepala
        if (Auth::user()->role == 'pengurus' || Auth::user()->role == 'kepala') {

            $statistik['anggota'] = number_format(User::count('id'), 0, ',', '.');

            // statistik bulan ini
            $statistik['anggotaBlnIni'] = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count('id');
            $statistik['anggotaBlnIni'] = number_format($statistik['anggotaBlnIni'], 0, ',', '.');

            // statistik kosakata
            $statistik['kosakata'] = number_format(Kosakata::count('id'), 0, ',', '.');
            $statistik['kosakataBlnIni'] = Kosakata::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count('id');
            $statistik['kosakataBlnIni'] = number_format($statistik['kosakataBlnIni'], 0, ',', '.');

            // statistik definisi
            $statistik['definisi'] = number_format(Definisi::count('id'), 0, ',', '.');
            $statistik['definisiBlnIni'] = Definisi::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count('id');
            $statistik['definisiBlnIni'] = number_format($statistik['definisiBlnIni'], 0, ',', '.');

            // statistik aritkel
            $statistik['post'] = Blog::count('id');
            $statistik['postPublish'] = Blog::whereNotNull('status')->count('id');

            // statistik laporan
            $statistik['laporanBlmDitangani'] = Report::whereNull('pengurus_id')->count();
            $statistik['laporanBlnIni'] = Report::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();


            $statistik['defTerverify'] = Definisi::where('verifikasi', '=', "1")->count('id');
            $data['statistik'] = $statistik;
        }

        // dapatkan data kontribusi user dalam 7 hari terakhir - kalau kepala tidak perlu dijalankan
        if ($user->role != 'kepala') {
            // dapatkan data selama 7 hari terakhir
            // definisi
            $def7hari = Definisi::where('user_id', $user->id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->whereNot('created_at', '>=', Carbon::now())
                ->orderBy('created_at', 'desc')
                ->get();
            // kosakata
            $kosakata7hari = Kosakata::where('user_id', $user->id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->whereNot('created_at', '>=', Carbon::now())
                ->orderBy('created_at', 'desc')
                ->get();

            // edit kosakata
            $edit7hari = EditKosakata::where('user_id', $user->id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->whereNot('created_at', '>=', Carbon::now())
                ->orderBy('created_at', 'desc')
                ->get();

            // laporan
            $laporan7hari = Report::where('user_id', $user->id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->whereNot('created_at', '>=', Carbon::now())
                ->orderBy('created_at', 'desc')
                ->get();

            // khusus pengurus
            if ($user->role == 'pengurus') {
                // artikel
                $blog7hari = Blog::where('user_id', $user->id)
                    ->whereNotNull('status')
                    ->where('status', '>=', Carbon::now()->subDays(7))
                    ->whereNot('status', '>=', Carbon::now())
                    ->orderBy('created_at', 'desc')
                    ->get();

                // memverifikasi definisi
                $verif7hari = Definisi::where('verifikasi_oleh', $user->id)
                    ->where('verifikasi', '>=', Carbon::now()->subDays(7))
                    ->whereNot('verifikasi', '>=', Carbon::now())
                    ->orderBy('verifikasi', 'desc')
                    ->get();

                // menindaklanjuti laporan
                $tindakLanjut7hari = Report::where('pengurus_id', $user->id)
                    ->where('status', '>=', Carbon::now()->subDays(7))
                    ->whereNot('status', '>=', Carbon::now())
                    ->orderBy('status', 'desc')
                    ->get();

                // verifikasi edit kosakata
                $verifEdit7hari = EditKosakata::where('pengurus_id', $user->id)
                    ->where('status', '>=', Carbon::now()->subDays(7))
                    ->whereNot('status', '>=', Carbon::now())
                    ->orderBy('status', 'desc')
                    ->get();
            }

            // digunakan untuk mengetahui nilai kontribusi tertinggi - untuk menghitung persentase. gunakan nilai 1 agar tidak error ketika user belum berkontribusi/ tidak ada kontribusi selama 7 hari terakhir
            $kontribusiTertinggi = 0;

            // jumlahkan ke tiap-tiap hari
            for ($i = 0; $i < 7; $i++) {
                // judul array
                $judul = $i == 0 ? 'Hari ini' : ($i == 1 ? 'Kemarin' : Carbon::now()->subDays($i)->translatedFormat('l'));

                // jumlahkan tiap kontribusi di hari tsb
                // definisi
                $def = $def7hari->filter(function ($item) use ($i) {
                    return $item->created_at->toDateString() == Carbon::now()->subDays($i)->toDateString();
                    // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                })->count();
                // kosakata
                $kos = $kosakata7hari->filter(function ($item) use ($i) {
                    return $item->created_at->toDateString() == Carbon::now()->subDays($i)->toDateString();
                    // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                })->count();
                // edit kosakata
                $edit = $edit7hari->filter(function ($item) use ($i) {
                    return $item->created_at->toDateString() == Carbon::now()->subDays($i)->toDateString();
                    // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                })->count();
                // laporan
                $lap = $laporan7hari->filter(function ($item) use ($i) {
                    return $item->created_at->toDateString() == Carbon::now()->subDays($i)->toDateString();
                    // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                })->count();
                if ($user->role == 'pengurus') {
                    // artikel
                    $blog = $blog7hari->filter(function ($item) use ($i) {
                        return $item->status->toDateString() == Carbon::now()->subDays($i)->toDateString();
                        // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                    })->count();
                    // memverifikasi definisi
                    $verifdef = $verif7hari->filter(function ($item) use ($i) {
                        return $item->verifikasi->toDateString() == Carbon::now()->subDays($i)->toDateString();
                        // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                    })->count();

                    // menindaklanjuti laporan
                    $tindaklanjutlap = $tindakLanjut7hari->filter(function ($item) use ($i) {
                        return $item->status->toDateString() == Carbon::now()->subDays($i)->toDateString();
                        // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                    })->count();
                    // verifikasi edit kosakata
                    $verifedit = $verifEdit7hari->filter(function ($item) use ($i) {
                        return $item->status->toDateString() == Carbon::now()->subDays($i)->toDateString();
                        // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                    })->count();
                }

                // simpan tanggal
                $tujuhhari[$judul]['tanggal'] = Carbon::now()->subDays($i)->translatedFormat('d F Y');

                // jumlahkan semua kontribusi dalam bentuk tiap-tiap hari
                $tujuhhari[$judul]['kontribusi'] = $def + $kos + $edit + $lap;
                if ($user->role == 'pengurus') {
                    $tujuhhari[$judul]['kontribusi'] = $tujuhhari[$judul]['kontribusi'] + $blog + $verifdef + $tindaklanjutlap + $verifedit;
                }

                // // digunakan untuk mengetahui nilai kontribusi tertingg - untuk menghitung persentase.
                if ($tujuhhari[$judul]['kontribusi'] > $kontribusiTertinggi) {
                    $kontribusiTertinggi = $tujuhhari[$judul]['kontribusi'];
                }
            }

            // hitung persentase kontribusi dari tiap hari
            for ($i = 0; $i < 7; $i++) {
                $judul = $i == 0 ? 'Hari ini' : ($i == 1 ? 'Kemarin' : Carbon::now()->subDays($i)->translatedFormat('l'));
                $tujuhhari[$judul]['persentase'] = round(($tujuhhari[$judul]['kontribusi'] / ($kontribusiTertinggi == 0 ? 1 : $kontribusiTertinggi)) * 100);
            }
            $data['tujuhhari'] = $tujuhhari;

            // CEK KAPAN TERAKHIR USER BERKONTRIBUSI
            // jika tidak berkontribusi lebih dari 7 hari...
            if ($kontribusiTertinggi < 1) {

                // dapatkan data kapan terakhir user berkontribusi
                // definisi
                $terakhirKontribusi['def'] = Definisi::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->first()
                    ->created_at ?? null;
                // kosakata
                $terakhirKontribusi['kosakata'] = Kosakata::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->first()
                    ->created_at ?? null;

                // edit kosakata
                $terakhirKontribusi['edit'] = EditKosakata::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->first()
                    ->created_at ?? null;

                // laporan
                $terakhirKontribusi['laporan'] = Report::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->first()
                    ->created_at ?? null;

                // khusus pengurus
                if ($user->role == 'pengurus') {
                    // artikel
                    $terakhirKontribusi['blog'] = Blog::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->first()
                        ->created_at ?? null;

                    // memverifikasi definisi
                    $terakhirKontribusi['verif'] = Definisi::where('verifikasi_oleh', $user->id)
                        ->orderBy('verifikasi', 'desc')
                        ->first()
                        ->verifikasi ?? null;

                    // menindaklanjuti laporan
                    $terakhirKontribusi['tindakLanjut'] = Report::where('pengurus_id', $user->id)
                        ->orderBy('status', 'desc')
                        ->first()
                        ->status ?? null;

                    // verifikasi edit kosakata
                    $terakhirKontribusi['verifEdit'] = EditKosakata::where('pengurus_id', $user->id)
                        ->orderBy('status', 'desc')
                        ->first()
                        ->status ?? null;
                }

                // dapatkan data paling awal
                $terakhir = Carbon::createFromFormat('Y-m-s', '0000-01-01'); // set data paling awal agar data dalam kontribusi terakhir pasti lebih besar dari data ini
                foreach ($terakhirKontribusi as $d) {
                    if ($d > $terakhir) {
                        $terakhir = $d;
                    }
                }
                // cek apakah user sudah berkontribusi/belum. kalau tanggal masih '0000-01-01', maka user belum berkontribusi
                if ($terakhir == Carbon::createFromFormat('Y-m-s', '0000-01-01')) {
                    $data['belumBerkontribusi'] = true;
                } else {
                    // hitung jarak kontribusi terakhir dengan hari, kemudian bulatkan (round) dan ubah selalu positif(abs)
                    $data['terakhirBerkontribusi'] = abs(round(Carbon::now()->diffInDays($terakhir)));
                }
            } else {
                // tampilakan definisi random (untuk semacam trivia)
                $definisiRandom = Definisi::where(function ($query) {
                    $query->whereNotNull('verifikasi_oleh')
                        ->orWhereHas('user', function ($q) {
                            $q->where('role', 'pengurus');
                        });
                })
                    ->whereNull('hukuman_edit')
                    ->whereHas('kosakata')
                    ->with('kosakata')
                    ->with('user')
                    ->with('pengurus')
                    ->inRandomOrder()
                    ->first();

                // jika tidak ada definisi random yang terverifikasi, maka tampilkan yang tidak terverifikasi
                if (empty($definisiRandom)) {
                    $definisiRandom = Definisi::whereHas('kosakata')
                        ->with('kosakata')
                        ->with('user')
                        ->with('pengurus')
                        ->inRandomOrder()
                        ->first();
                }
                $data['definisiRandom'] = $definisiRandom;
            }
        }

        // Tampilkan achievement untuk pengurus & kontributor
        if (Auth::user()->role == 'pengurus' || Auth::user()->role == 'kontributor') {
            // Achievement
            $achieved = Auth::user()->achievement ?? [];
            $achievement = Achievement::whereIn('id', array_keys($achieved))->limit(4)->get();
            foreach ($achievement as $d) {
                $d->date_achieved = Carbon::parse($achieved[$d->id])->timezone('Asia/Jakarta');
            }
            $achievement = $achievement->sortByDesc('date_achieved')->take(4); //urutkan achievement
            $data['achievement'] = $achievement;
        }

        // dapatkan data banner
        $banner = $this->getBanner([7]);
        $data['banner'] = $banner;

        // cek apakah user tersuspend atau tidak
        $data['suspend'] = $this->cekSuspend(Auth::user()->id);

        //cek sertifikat
        $this->cekSertifikat(Auth::user()->id);
        return view('dashboard.index', $data);
    }

    // Kontribusi - Kontributor
    public function kontribusi()
    {
        // Kosakata
        $data['kosakata'] = Kosakata::where('user_id', '=', Auth::user()->id);
        $statistik['kosakataTotal'] = (clone $data['kosakata'])->count(); //kosakata total
        $statistik['kosakataBln'] = (clone $data['kosakata'])->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month)->count();
        $data['kosakata'] = $data['kosakata']->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'kosakata-page')
            ->onEachSide(2)
            ->appends(request()->query());

        // tambah edit kosakata
        $data['editKosakata'] = EditKosakata::with('kosakata')
            ->where('user_id', '=', Auth::user()->id);
        $statistik['editKosakataDisetujui'] = (clone $data['editKosakata'])->whereNotNull('status')->count();
        $statistik['editKosakataTotal'] = (clone $data['editKosakata'])->count(); //editKosakata total
        $data['editKosakata'] = $data['editKosakata']->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'editKosakata-page')
            ->onEachSide(2)
            ->appends(request()->query());

        // definisi
        $data['definisi'] = Definisi::with([
            'kosakata' => function ($query) {
                $query->withTrashed();
            }
        ])
            ->with([
                'user' => function ($query) {
                    $query->withTrashed();
                }
            ])
            ->where('user_id', '=', Auth::user()->id);
        $statistik['definisiTotal'] = (clone $data['definisi'])->count();
        $statistik['definisiBln'] = (clone $data['definisi'])->whereYear('updated_at', Carbon::now()->year)->whereMonth('updated_at', '=', Carbon::now()->month)->count();
        $data['definisi'] = $data['definisi']->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'definisi-page')
            ->onEachSide(2)
            ->appends(request()->query());

        // verifikasi definisi
        if (Auth::user()->role == 'pengurus') {
            $data['verifDefinisi'] = Definisi::with([
                'kosakata' => function ($query) {
                    $query->withTrashed();
                }
            ])
                ->where('verifikasi_oleh', Auth::user()->id)
                ->whereNotNull('verifikasi');
            $statistik['verifDefinisiTotal'] = (clone $data['verifDefinisi'])->count();
            $statistik['verifDefinisiBln'] = (clone $data['verifDefinisi'])->whereYear('verifikasi', Carbon::now()->year)->whereMonth('verifikasi', '=', Carbon::now()->month)->count();
            $data['verifDefinisi'] = $data['verifDefinisi']->orderBy('updated_at', 'desc')
                ->paginate(10, ['*'], 'definisi-page')
                ->onEachSide(2)
                ->appends(request()->query());
        }

        // dapatkan data laporan
        $data['laporan'] = Report::with([
            'definisi' =>
                function ($query) {
                    $query->withTrashed();
                }
        ])
            ->with('kosakata', function ($query) {
                $query->withTrashed();
            })
            ->where('user_id', '=', Auth::user()->id);
        $statistik['laporanPending'] = (clone $data['laporan'])->whereNull('status')->count(); //pakai "clone" agar query  didalam $data['laporan'] tidak berubah
        $statistik['laporanTotal'] = $data['laporan']->count();

        // aplikasikan filter
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
            if (isset($d['definisi'])) {
                // jika yang dilaporkan = definisi
                $d['terlapor'] = User::find($d['definisi']['user_id'])->nama ?? '[Akun dihapus]';
                // cari data kosakata
                $d['kosakata'] = Kosakata::withTrashed()
                    ->where('id', '=', $d['definisi']['kosakata_id'])
                    ->value('kosakata');
            } else if (isset($d['kosakata'])) {
                // jika yang dilaporkan = kosakata
                $d['terlapor'] = User::find($d['kosakata']['user_id'])->nama ?? '[Akun dihapus]';
            } else {
                $d['terlapor'] = null;
                $teks = '-';
            }
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

        $definisi = Definisi::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $kosakata = Kosakata::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $editkosakata = EditKosakata::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->whereHas('user', function ($query) {
            $query->where('role', 'kontributor');
        })->count();
        $laporan = Report::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->whereHas('user', function ($query) {
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
            $d['level'] = $this->levelCalculator($d->id);
            // kontribusi total
            $definisi = Definisi::where('user_id', '=', $d->id)->count();
            $kosakata = Kosakata::where('user_id', '=', $d->id)->count();
            $editkosakata = EditKosakata::where('user_id', '=', $d->id)->count();
            $laporan = Report::where('user_id', '=', $d->id)->count();
            $d['kontribusiTotal'] = $definisi + $kosakata + $editkosakata + $laporan;
            // kontribusi bulan ini
            $definisi = Definisi::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();
            $kosakata = Kosakata::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();
            $editkosakata = EditKosakata::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();
            $laporan = Report::where('user_id', '=', $d->id)->whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();
            $d['kontribusiBlnIni'] = $definisi + $kosakata + $editkosakata + $laporan;
        }

        // data kontributor yang telah menghapus akunnya
        $kontributorDihapus = HapusAkun::with([
            'user' => function ($query) {
                $query->withTrashed();
            }
        ])
            ->whereHas('user', function ($query) {
                $query->where('role', 'kontributor');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'kontributor')
            ->onEachSide(2)
            ->appends(request()->query());

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
            ->with('kosakata', function ($query) {
                $query->withTrashed();
            })
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
            'kontributorDihapus' => $kontributorDihapus,
            'kosakata' => $kosakata,
            'definisi' => $definisi,
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
        $kosakata = Kosakata::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $definisi = Definisi::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $editkosakata = EditKosakata::whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $laporan = Report::whereNotNull('status')->whereMonth('status', '=', Carbon::now()->month)->whereYear('status', Carbon::now()->year)->count();
        $blog = Blog::whereNotNull('status')->whereMonth('status', '=', Carbon::now()->month)->whereYear('status', Carbon::now()->year)->count();
        // kurang banner
        $overview['kontribusiBlnIni'] = $kosakata + $definisi + $editkosakata + $laporan + $blog;

        // kontributsi pengurus bulan lalu

        // menentukan tahun (mencegah error saat di bulan januari)
        if (Carbon::now()->month == '01') {
            $tahun = Carbon::now()->subYear()->year;
        } else {
            $tahun = Carbon::now()->year;
        }

        $kosakata = Kosakata::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->whereYear('created_at', $tahun)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $definisi = Definisi::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->whereYear('created_at', $tahun)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $editkosakata = EditKosakata::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->whereYear('created_at', $tahun)->whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })->count();
        $laporan = Report::whereNotNull('status')->whereMonth('status', '=', Carbon::now()->subMonth()->month)->whereYear('status', $tahun)->count();
        $blog = Blog::whereNotNull('status')->whereMonth('status', '=', Carbon::now()->subMonth()->month)->whereYear('status', $tahun)->count();
        // kurang banner
        $overview['kontribusiBlnKmrn'] = $kosakata + $definisi + $editkosakata + $laporan + $blog;
        // dd($kosakata);

        // data pengurus
        $pengurus = User::where('role', '=', 'pengurus')
            ->orderBy('poin', 'desc')
            ->paginate(10, '*', 'pengurus')
            ->onEachSide(2)
            ->appends(request()->query());

        foreach ($pengurus as $d) {
            // level
            $d['level'] = $this->levelCalculator($d->id);
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

            // cek apakah data user terhapus
            if ($d->trashed()) {
                $d->statusUser = 'dihapus';
            }
        }

        // data pengurus yang telah menghapus akunnya
        $pengurusDihapus = HapusAkun::with([
            'user' => function ($query) {
                $query->withTrashed();
            }
        ])
            ->whereHas('user', function ($query) {
                $query->where('role', 'pengurus');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'pengurus')
            ->onEachSide(2)
            ->appends(request()->query());

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
            ->with('kosakata', function ($query) {
                $query->withTrashed();
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'definisi')
            ->onEachSide(2)
            ->appends(request()->query());

        $editKosakata = EditKosakata::whereNotNull('pengurus_id')
            ->with('kosakata', function ($query) {
                $query->withTrashed();
            })
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
            'pengurusDihapus'=>$pengurusDihapus ,
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
