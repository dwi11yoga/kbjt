<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Definisi;
use App\Models\Donasi;
use App\Models\EditKosakata;
use App\Models\Kosakata;
use App\Models\User;
use Carbon\Carbon;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    //Beranda
    public function index()
    {
        // Ambil top 100 user
        $topContributor = User::select(['username', 'nama', 'profile_pic', 'jenis_kelamin', 'poin'])
            ->orderBy('poin', 'asc')
            ->limit(100)
            ->get();

        // Ambil definisi random
        $definisi = Definisi::where(function ($query) {
            $query->whereNotNull('verifikasi_oleh')
                ->orWhereHas('user', function ($q) {
                    $q->where('role', 'pengurus');
                });
        })
            ->whereNull('hukuman_edit')
            ->whereHas('kosakata')
            ->inRandomOrder()
            ->take(5)
            ->with('kosakata:id,kosakata,slug')
            ->with('user')
            ->with('pengurus')
            ->get();
        foreach ($definisi as $d) {
            $d['slug'] = $d->kosakata->slug;
            $d['kosakata'] = $d->kosakata->kosakata;
        }

        // ambil 5 artikel terbaru
        $artikel = Blog::orderBy('created_at', 'desc')->take(5)->get();

        // dapatkan statistik web
        $jmlAnggota = number_format(User::select('id')->count(), 0, ',', '.');
        $jmlKosakata = number_format(Kosakata::select('id')->count(), 0, ',', '.');
        $jmlDefinisi = number_format(Definisi::select('id')->count(), 0, ',', '.');
        $jmlTerverifikasi = number_format(Definisi::select('id')->whereNotNull('verifikasi')->count(), 0, ',', '.');

        return view('homepage.index', [
            'group' => 'homepage',
            'title' => 'Selamat datang di Kamus Bahasa Jawa Terbuka!',
            'topContributor' => $topContributor,
            'definisi' => $definisi,
            'artikel' => $artikel,
            'jmlAnggota' => $jmlAnggota,
            'jmlKosakata' => $jmlKosakata,
            'jmlDefinisi' => $jmlDefinisi,
            'jmlTerverifikasi' => $jmlTerverifikasi
        ]);
    }

    // Daftar Kosakata
    public function daftarKosakata(Request $request)
    {
        // Dapatkan data kosakata
        $filter = isset($request->filter) ? $request->filter : 'A';
        $kosakata = Kosakata::select(['user_id', 'kosakata', 'slug', 'ragam'])
            ->whereLike('kosakata', $filter . '%')
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'nama');
                }
            ])
            ->orderBy('kosakata', 'asc')
            ->get();

        // dapatkan data banner
        $banner = $this->getBanner([1, 2]);

        return view('homepage.daftar-kosakata', [
            'group' => 'kosakata',
            'title' => 'Daftar Kosakata',
            'filter' => $filter,
            'kosakata' => $kosakata,
            'banner' => $banner
        ]);
    }

    // Hall of Fame
    public function hallOfFame()
    {
        // dapatkan data user
        $user = User::select('id', 'username', 'poin', 'created_at', 'jenis_kelamin', 'profile_pic')
            ->orderBy('poin', 'desc')
            ->limit(100)
            ->get();

        // hitung level user
        foreach ($user as $d) {
            $d['level'] = $this->levelCalculator($d['id']);
            $d['poin'] = number_format($d['poin'], 0, ',', '.');
        }

        // dapatkan data banner
        $banner = $this->getBanner([1, 2]);

        return view('homepage.hall-of-fame', [
            'group' => 'hall of fame',
            'title' => 'Hall of Fame',
            'user' => $user,
            'banner' => $banner
        ]);
    }

    // Blog
    public function blog()
    {
        // dapatkan daftar artikel
        $blog = Blog::whereNotNull('status')
            ->with('user:id,nama')
            ->orderBy('pinned', 'desc')
            ->orderBy('status', 'desc')
            ->paginate(10);

        // dapatkan data banner
        $banner = $this->getBanner([1, 2]);

        return view('homepage.blog', [
            'group' => 'blog',
            'title' => 'Blog',
            'posts' => $blog,
            'banner' => $banner
        ]);
    }

    // Blog Post
    public function blogPost($slug)
    {
        // Ambil data artikel
        $post = Blog::where('slug', '=', $slug)
            ->with('user:id,username,nama,jenis_kelamin,profile_pic')
            ->first();

        // Jika bukan halaman preview dan Jika status post ==0 (draf)
        if (empty($post) || (empty($post['status']) && $_SERVER['REQUEST_URI'] != '/blog/preview/' . $slug)) {
            return $this->error404();
        }

        // Jika artikel sudah dipublikasikan, namun url adalah preview, maka redirect
        if ($_SERVER['REQUEST_URI'] == '/blog/preview/' . $slug && isset($post['status'])) {
            return redirect('/blog/post/' . $slug);
        }

        // cek apakah artikel adalah dokumentasi/tidak
        $potongJudul = substr($post->judul, 0, 12);
        if ($potongJudul == 'Dokumentasi:') {
            $post->dokumentasi = true;
        } else {
            $post->dokumentasi = false;
        }

        // dd($potongJudul);

        // dapatkan url web
        $url = $this->getUrl();

        // tambahkan view di database
        // cek apakah user sudah mengunjungi halaman tsb hari ini
        // jika user hari ini belum membaca artikel, naikkan view artikel (pakai cookie)
        if (!Cookie::has('artikel_' . $post->id) && !empty($post->status)) { // cek apakah user sudah mengunjungi artikel hari ini (cek ada/tidaknya cookie)
            Blog::find($post->id)->increment('view', 1); // naikkan view definis
            Cookie::queue('artikel_' . $post->id, true, (24 * 60)); // buat cookie (kedaluarsa dalam 1 hari)
        }

        // dapatkan data banner
        $banner = $this->getBanner([1, 2, 3, 4]);

        // dapatkan data artikel lainnya (6)
        $artikelLain = Blog::with('user')
            ->whereNotNull('status')
            ->where('id', '!=', $post->id)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('homepage.post', [
            'group' => 'blog',
            'title' => $post->judul,
            'post' => $post,
            'url' => $url,
            'banner' => $banner,
            'artikelLain' => $artikelLain
        ]);
    }

    // Donasi
    public function donasi()
    {

        // ambil daftar metode donasi
        $metode = Donasi::select('metode')->orderBy('metode', 'asc')->get();
        if (!empty(request('metode-pembayaran'))) {
            $metode_dipilih = request('metode-pembayaran');
        } else {
            $metode_dipilih = $metode->first()->metode;
            // $metode_dipilih = Donasi::orderBy('metode', 'asc')->value('metode');
        }
        $donasi = Donasi::where('metode', '=', $metode_dipilih)->first();

        // dapatkan data banner
        $banner = $this->getBanner([1, 2]);

        // dapatkan url web
        $urlweb = $this->getUrl();

        return view('homepage.donasi', [
            'group' => 'donasi',
            'title' => 'Dukungan',
            'donasi' => $donasi,
            'metode' => $metode,
            'banner' => $banner,
            'urlweb' => $urlweb,
        ]);
    }

    // Pencarian
    public function pencarian(Request $request)
    {
        $keyword = $request->keyword;
        $filter = $request->filter;

        if (empty($keyword)) {
            $data = null;
        } elseif ($filter == 'kosakata' || empty($filter)) {
            // Cari kosakata
            $data = Kosakata::select('id', 'kosakata', 'user_id', 'slug', 'aksara', 'ragam', 'jenis', 'arti_indo')
                ->with('user:id,username,nama,jenis_kelamin,profile_pic')
                ->where('kosakata', 'like', '%' . $keyword . '%')
                ->orWhere('arti_indo', 'like', '%' . $keyword . '%')
                ->orWhere('aksara', 'like', '%' . $keyword . '%')
                ->paginate(10)
                ->appends(request()->query());
            foreach ($data as $d) {
                $d['jmlDefinisi'] = Definisi::select('id')
                    ->where('kosakata_id', '=', $d->id)
                    ->count();
                if ($d['jmlDefinisi'] > 0) {
                    $d['jmlTerverifikasi'] = Definisi::select('id')
                        ->where('kosakata_id', '=', $d->id)
                        ->whereNotNull('verifikasi')
                        ->count();
                } else {
                    $d['jmlTerverifikasi'] = 0;
                }
            }
        } elseif ($filter == 'artikel') {
            // cari artikel
            $data = Blog::select('id', 'judul', 'slug', 'user_id', 'thumbnail', 'status', 'updated_at')
                ->with('user:id,username,nama,jenis_kelamin,profile_pic')
                ->whereNotNull('status')
                ->where('judul', 'like', '%' . $keyword . '%')
                ->orderBy('updated_at', 'desc')
                ->paginate(10)
                ->appends(request()->query());
        } elseif ($filter == 'pengguna') {
            // Cari pengguna
            $data = User::where('username', 'like', '%' . $keyword . '%')
                ->orWhere('nama', 'like', '%' . $keyword . '%')
                ->orderBy('poin', 'desc')
                ->paginate(10)
                ->appends(request()->query());

            // Hitung & tambahkan level pada $user
            foreach ($data as $d) {
                $d['level'] = $this->levelCalculator($d['id']);
            }
        } else {
            $data = [];
        }
        $jumlah = !empty($data) ? count($data) : 0;

        // dapatkan data banner
        $banner = $this->getBanner([1, 2]);

        return view('homepage.pencarian', [
            'group' => 'pencarian',
            'title' => 'Pencarian',
            'data' => $data,
            'jumlah' => $jumlah,
            'banner' => $banner
        ]);
    }

    // View halaman kosakata & definisi
    public function kosakata($slug)
    {
        // ambil data kosakata
        $kosakata = Kosakata::where('slug', '=', $slug)
            ->with('user:id,username,nama,jenis_kelamin,profile_pic')
            ->first();

        // tampilkan data edit (jika ada)
        if (!empty($kosakata)) {
            $cekEdit = EditKosakata::where('kosakata_id', '=', $kosakata->id)
                ->whereNotNull('pengurus_id')
                ->with('user:id,username,nama,jenis_kelamin,profile_pic')
                ->orderBy('updated_at', 'desc')
                ->first();
            if (isset($cekEdit)) {
                $kosakata->aksara = $cekEdit->aksara;
                $kosakata->ragam = $cekEdit->ragam;
                $kosakata->jenis = $cekEdit->jenis;
                $kosakata->notasi_fonetik = $cekEdit->notasi_fonetik;
                $kosakata->arti_indo = $cekEdit->arti_indo;
                $kosakata->etimologi = $cekEdit->etimologi;
                $kosakata->serupa = $cekEdit->serupa;
            }
        }

        // Hitung jumlah kolom null
        $cekKolom = ['ragam', 'aksara', 'jenis', 'notasi_fonetik', 'arti_indo', 'etimologi', 'serupa'];
        $nullCount = 0;
        if (isset($kosakata)) {
            foreach ($cekKolom as $d) {
                if (is_null($kosakata[$d])) {
                    $nullCount += 1;
                }
            }
        }

        // tambahkan view di database
        // cek apakah user sudah mengunjungi kosakata tsb hari ini
        // jika user hari ini belum melihat kosakata, naikkan view kosakata (pakai cookie)
        if (!Cookie::has('kosakata_' . $kosakata->id)) { // cek apakah user sudah mengunjungi kosakata hari ini (cek ada/tidaknya cookie)
            Kosakata::find($kosakata->id)->increment('view', 1); // naikkan view kosakata
            Cookie::queue('kosakata_' . $kosakata->id, true, (24 * 60)); // buat cookie (kedaluarsa dalam 1 hari)
        }

        // ambil data definisi
        $definisi = [];
        if (isset($kosakata)) {
            $definisi = Definisi::where('kosakata_id', '=', $kosakata->id)
                ->with('user:id,username,nama,profile_pic,jenis_kelamin,role')
                ->with('pengurus:id,username,nama')
                ->where(function ($query) {
                    $query->whereNull('hukuman_edit')
                        ->orWhere('hukuman_edit', '!=', 1);
                });
            if (!empty(request()->bahasa) && request()->bahasa != 'semua') {
                $definisi = $definisi->where('bahasa', request()->bahasa);
            }
            if (isset(request()->definisi)) {
                $definisi = $definisi->orderByRaw('id=? DESC', [request()->definisi]);
            }
            $definisi = $definisi->orderBy('verifikasi', 'desc')
                ->orderBy('updated_at', 'desc')
                ->paginate(10);

            foreach ($definisi as $d) {
                $d['kosakata'] = $kosakata->kosakata;
                $d['slug'] = $kosakata->slug;
                if (isset(request()->definisi) && request()->definisi == $d->id) {
                    $d['selected'] = 1;
                }
            }
        }

        // dapatkan data banner
        $banner = $this->getBanner([1, 2, 5, 6]);

        // dapatkan url kosakata
        $url = $this->getUrl();

        // cek apakah user tersuspend
        if (!empty(Auth::user()->id)) {
            $suspend = $this->cekSuspend(Auth::user()->id);
        }
        // dd($suspend);

        return view('homepage.kosakata', [
            'group' => 'pencarian',
            'title' => ucfirst($kosakata->kosakata),
            'kosakata' => $slug,
            'data' => $kosakata,
            'url' => $url,
            'dataNull' => $nullCount,
            'definisi' => $definisi,
            'banner' => $banner,
            'suspend' => $suspend ?? null
        ]);
    }

    // view riwayat edit kosakata
    public function riwayatKosakata($slug)
    {
        $kosakata = Kosakata::where('slug', '=', $slug)->first();

        // alihkan jika kosakata dihapus/tidak ditemukan
        if (empty($kosakata)) {
            return $this->error404();
        }

        $riwayat = EditKosakata::where('kosakata_id', '=', $kosakata->id);
        if (empty(Auth::user()->role) || Auth::user()->role == 'kontributor') {
            $riwayat = $riwayat->whereNotNull('status');
        }
        $riwayat = $riwayat->with('user:id,username,nama,jenis_kelamin,profile_pic')
            ->with('pengurus:id,username,nama,jenis_kelamin,profile_pic')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // dapatkan data banner
        $banner = $this->getBanner([1, 2]);

        return view('homepage.riwayat-kosakata', [
            'title' => 'Riwayat',
            'group' => null,
            'kosakata' => $kosakata,
            'riwayat' => $riwayat,
            'banner' => $banner
        ]);
    }

    // view user terbanned
    public function dibanned()
    {
        return view('homepage.terbanned', [
            'title' => 'Akun kamu tidak dapat diakses',
            'group' => null,
        ]);
    }

    // halaman credit/tentang
    public function tentang()
    {
        return view('homepage.credit', [
            'title' => 'Tentang',
            'group' => null
        ]);
    }

    public function syaratKetentuan()
    {
        return view('homepage.syarat-ketentuan', [
            'title' => 'Syarat dan Ketentuan',
            'group' => null
        ]);
    }
}
