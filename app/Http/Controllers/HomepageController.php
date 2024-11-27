<?php

namespace App\Http\Controllers;

use App\Models\Kosakata;
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
    public function daftarKosakata()
    {
        return view('homepage.daftar-kosakata', [
            'group' => 'kosakata',
            'title' => 'Daftar Kosakata'
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

        $kosakata = Kosakata::select(['kosakata', 'slug', 'aksara', 'ragam', 'jenis', 'arti_indo'])
            ->where('kosakata', 'like', '%' . $request->keyword . '%')
            ->orWhere('arti_indo', 'like', '%' . $request->keyword . '%')
            ->orWhere('aksara', 'like', '%' . $request->keyword . '%')
            ->get();
        $jumlahKosakata = count($kosakata);
        return view('homepage.pencarian', [
            'group' => 'pencarian',
            'title' => 'Pencarian',
            'kosakata' => $kosakata,
            'jumlahKosakata' => $jumlahKosakata
        ]);
    }

    public function kosakata($slug)
    {
        $kosakata = Kosakata::firstWhere('slug', $slug);
        $cekKolom = ['ragam', 'aksara', 'jenis', 'notasi_fonetik', 'arti_indo', 'etimologi', 'serupa'];
        $nullCount = 0;
        foreach ($cekKolom as $d) {
            if (is_null($kosakata[$d])) {
                $nullCount += 1;
            }
        }
        return view('homepage.kosakata', [
            'group' => 'pencarian',
            'title' => 'Kosakata',
            'data' => $kosakata,
            'dataNull' => $nullCount
        ]);
    }
}
