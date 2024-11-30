<?php

namespace App\Http\Controllers;

use App\Models\Definisi;
use App\Models\Kosakata;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //Beranda
    public function index()
    {
        return view('homepage.index', [
            'group' => 'homepage',
            'title' => 'Selamat datang di Kamus Bahasa Jawa Terbuka!'
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

        return view('homepage.daftar-kosakata', [
            'group' => 'kosakata',
            'title' => 'Daftar Kosakata',
            'filter' => $filter,
            'kosakata' => $kosakata
        ]);
    }

    // Hall of Fame
    public function hallOfFame()
    {
        return view('homepage.hall-of-fame', [
            'group' => 'hall of fame',
            'title' => 'Hall of Fame'
        ]);
    }

    // Blog
    public function blog()
    {
        return view('homepage.blog', [
            'group' => 'blog',
            'title' => 'Blog'
        ]);
    }

    // Blog Post
    public function blogPost()
    {
        return view('homepage.post', [
            'group' => 'blog',
            'title' => 'Post'
        ]);
    }

    // Donasi
    public function donasi()
    {
        return view('homepage.donasi', [
            'group' => 'donasi',
            'title' => 'Donasi'
        ]);
    }

    // Pencarian
    public function pencarian(Request $request)
    {
        $keyword = $request->keyword;
        // Cari kosakata
        $kosakata = Kosakata::select(['kosakata', 'slug', 'aksara', 'ragam', 'jenis', 'arti_indo'])
            ->where('kosakata', 'like', '%' . $keyword . '%')
            ->orWhere('arti_indo', 'like', '%' . $keyword . '%')
            ->orWhere('aksara', 'like', '%' . $keyword . '%')
            ->get();
        $jumlahKosakata = count($kosakata);

        // Cari pengguna
        $user = User::select(['username', 'nama', 'profile_pic', 'poin', 'jenis_kelamin'])
            ->whereLike('username', '%' . $keyword . '%')
            ->orWhereLike('nama', '%' . $keyword . '%')
            ->get();
        $jumlahUser = count($user);

        // Hitung & tambahkan level pada $user
        $user = $user->map(function ($item) {
            $item->level = $this->levelCalculator($item->poin); // Tambahkan atribut 'level'
            return $item;
        });

        return view('homepage.pencarian', [
            'group' => 'pencarian',
            'title' => 'Pencarian',
            'kosakata' => $kosakata,
            'jumlahKosakata' => $jumlahKosakata,
            'user' => $user,
            'jumlahUser' => $jumlahUser
        ]);
    }

    // Halaman kosakata & definisi
    public function kosakata($slug)
    {
        // ambil data kosakata
        $kosakata = Kosakata::firstWhere('slug', $slug);
        $cekKolom = ['ragam', 'aksara', 'jenis', 'notasi_fonetik', 'arti_indo', 'etimologi', 'serupa'];

        // Hitung jumlah kolom null
        $nullCount = 0;
        if (isset($kosakata)) {
            foreach ($cekKolom as $d) {
                if (is_null($kosakata[$d])) {
                    $nullCount += 1;
                }
            }
        }

        // ambil data definisi
        $definisi = [];
        if (isset($kosakata)) {
            $definisi = Definisi::where('kosakata_id', $kosakata['id'])
                ->with([
                    'user' => function ($query) {
                        $query->select('id', 'nama', 'username', 'profile_pic', 'jenis_kelamin');
                    }
                ])
                ->get();
        }

        // dd($definisi);

        return view('homepage.kosakata', [
            'group' => 'pencarian',
            'title' => 'Kosakata',
            'kosakata' => $slug,
            'data' => $kosakata,
            'dataNull' => $nullCount,
            'definisi' => $definisi
        ]);
    }
}
