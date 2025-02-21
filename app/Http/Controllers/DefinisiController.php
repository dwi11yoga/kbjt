<?php

namespace App\Http\Controllers;

use App\Models\Definisi;
use App\Models\PoinKontribusi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DefinisiController extends Controller
{
    // Tambah definisi
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'kosakata_id' => 'required|exists:kosakata,id',
            'definisi' => 'required|min:10',
            'referensi' => '',
        ]);

        $arrayReferensi = null;
        if (isset($validatedData['referensi'])) {
            $arrayReferensi = array_map('trim', explode(';', $validatedData['referensi']));
        }

        // tambah poin
        $tambahPoin = PoinKontribusi::where('kontribusi', '=', 'Menambah definisi')
            ->where('role', '=', Auth::user()->role)
            ->value('poin');
        if (!empty($tambahPoin)) {
            User::where('id', '=', Auth::user()->id)->increment('poin', $tambahPoin);
        }

        // simpan
        Definisi::create([
            'kosakata_id' => $validatedData['kosakata_id'],
            'user_id' => Auth::user()->id,
            'definisi' => $validatedData['definisi'],
            'referensi' => $arrayReferensi,
            'poin' => $tambahPoin ?? 0
        ]);

        // cek achievement
        $jumlahDefinisi = Definisi::where('user_id', '=', Auth::user()->id)->count();
        $this->achievement(Auth::user()->id, 'definisi', $jumlahDefinisi);

        return back()->with('success', 'Definisi berhasil ditambahkan');
    }

    // Simpan edit definisi
    public function update(Request $request, $slug, $userId)
    {
        // Validasi
        try {
            $validatedData = $request->validate([
                'editDefinisi' => 'required|min:10',
            ]);
        } catch (ValidationException $e) {
            return back()->with('failed', 'Gagal mengedit definisi')
                ->withErrors($e->errors())
                ->withInput();
        }

        $arrayReferensi = null;
        if (isset($request->editReferensi)) {
            $arrayReferensi = array_map('trim', explode(';', $request->editReferensi));
        }

        // Simpan
        Definisi::find($userId)->update([
            'definisi' => $validatedData['editDefinisi'],
            'referensi' => $arrayReferensi
        ]);

        return back()->with('success', 'Definisi berhasil diedit');
    }

    // Hapus definisi
    public function delete($slug, $definisiId)
    {
        // Cek apakah definisi benar-benar milik user
        $definisi = Definisi::select('id', 'user_id')->where('id', '=', $definisiId)->first();
        if (isset($definisi) && $definisi['user_id'] != Auth::user()->id ?? 0) {
            return back()->with('failed', 'Gagal menghapus definisi');
        }
        // hapus definisi
        Definisi::destroy($definisiId);
        return back()->with('success', 'Definisi berhasil dihapus');

    }
}
