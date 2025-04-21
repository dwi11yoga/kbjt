<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    //view notifikasi
    public function index()
    {
        // Ambil data dari database
        $notif = Notifikasi::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // sortir berdasarkan tanggal
        // dapatkan data tanggal
        $tanggal = (clone $notif)->pluck('created_at') // ambil hanya kolom created_at saja
            ->map(fn($item) => $item->toDateString()) // ubah firmat tanggal ke yyyy-mm-dd, menggunakan map untuk mengubah atau memodifikasi setiap item dalam sebuah koleksi
            ->unique(); // jangan simpan tanggal duplikat

        // Lakukan pengelompokan
        foreach ($tanggal as $d) {
            $key = $d == Carbon::now()->toDateString() ? 'Hari ini' : ($d == Carbon::yesterday()->toDateString() ? 'Kemarin' : Carbon::createFromFormat('Y-m-d', $d)->translatedFormat('d F Y'));
            $data[$key] = $notif->filter(function ($item) use ($d) { // lakukan filter
                return $item->created_at->toDateString() == $d; // kembalikan $item jika created_at sama dengan $d
            });
        }

        // ubah status notifikasi yang belum dibaca menjadi dibaca
        $belumDilihat=(clone $notif)->where('dilihat', 0)->pluck('id');
        // cek apakah ditemukan notif yang belum dilihat
        if ($belumDilihat->isNotEmpty()) {
            // update menjadi dilihat
            Notifikasi::whereIn('id', $belumDilihat)->update(['dilihat'=>1]);
        }

        // kembalikan view
        return view("dashboard.notifikasi", [
            'title' => 'Notifikasi',
            'group' => 'notifikasi',
            'data' => $data
        ]);
    }
}
