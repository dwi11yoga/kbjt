<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //laporkan definisi
    public function definisi(Request $request)
    {
        // cek apakah laporan sudah dilaporkan/belum
        $cek = Report::where('user_id', '=', Auth::user()->id)
            ->where('definisi_id', '=', $request->id)
            ->where('jenis', '=', $request->alasan)
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

        // Simpan ke database
        $data = [
            'user_id' => Auth::user()->id,
            'definisi_id' => request()->id,
            'jenis' => $validatedData['alasan'],
        ];
        if (isset($request->keterangan)) {
            $data['keterangan'] = $request->keterangan;
        }

        Report::create($data);
        return back()->with('success', 'Definisi berhasil dilaporkan');
    }
}
