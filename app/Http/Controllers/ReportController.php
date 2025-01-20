<?php

namespace App\Http\Controllers;

use App\Models\Definisi;
use App\Models\Kosakata;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ReportController extends Controller
{
    //laporkan definisi
    public function definisi(Request $request)
    {
        // cek apakah laporan sudah dilaporkan/belum
        $cek = Report::where('user_id', '=', Auth::user()->id)
            ->where('definisi_id', '=', $request->id)
            ->where('alasan', '=', $request->alasan)
            ->first();
        if (isset($cek)) {
            return back()->with('failed', 'Laporan sudah dibuat')->withInput();
        }

        // validasi
        if (empty($request->alasan)) {
            return back()->with('failed', 'Gagal menyimpan laporan, coba lagi')->withInput()->withErrors(['alasan' => 'alasan field is required']);
        }
        $validatedData = $request->validate([
            'alasan' => 'required'
        ]);
        if (empty($request->id)) {
            return back()->with('failed', 'Gagal menyimpan laporan, coba lagi')->withInput();
        }

        // dapatkan data definisi
        $definisi = Definisi::select('id', 'definisi', 'referensi', 'updated_at')->where('id', '=', $request->id)->first();

        // Simpan ke database
        $data = [
            'user_id' => Auth::user()->id,
            'definisi_id' => request()->id,
            'alasan' => $validatedData['alasan'],
            'def_dilaporkan' => $definisi->definisi,
            'ref_dilaporkan' => $definisi->referensi,
            'waktu_definisi' => $definisi->updated_at
        ];
        if (isset($request->catatan)) {
            $data['catatan'] = $request->catatan;
        }

        Report::create($data);
        return back()->with('success', 'Definisi berhasil dilaporkan');
    }

    // Detail Laporan
    public function kontributorView($id)
    {
        $laporan = Report::where('id', '=', $id)
            ->with('user:id,username,nama,role')
            ->with('definisi:id,kosakata_id,user_id,definisi,referensi,verifikasi,updated_at')
            ->first();
        $laporan->author = User::select('id', 'nama', 'username', 'role', 'profile_pic', 'jenis_kelamin')->where('id', '=', $laporan->definisi->user_id)->first();
        $laporan->kosakata = Kosakata::select('id', 'kosakata', 'slug')->where('id', '=', $laporan->definisi->kosakata_id)->first();
        $laporan->idZerofill = str_pad($laporan->id, 10, '0', STR_PAD_LEFT);

        // definisi
        $definisi = new stdClass(); //inisiasi object definisi
        $definisi->menu = 12;
        $definisi->slug = $laporan->kosakata->slug;
        $definisi->kosakata = $laporan->kosakata->kosakata;
        $definisi->definisi = $laporan->def_dilaporkan;
        $definisi->referensi = $laporan->ref_dilaporkan;
        $definisi->updated_at = $laporan->waktu_definisi;
        $definisi->user = $laporan->author;
        $definisi->copies = 1;
        // cek apakah definisi yang asli sudah diupdate
        $definisi->updated = $definisi->updated_at == $laporan->definisi->updated_at ? 1 : 0;

        return view('dashboard.laporan-detail', [
            'title' => 'Laporan',
            'group' => 'kontribusi',
            'laporan' => $laporan,
            'definisi' => $definisi,
        ]);
    }
}
