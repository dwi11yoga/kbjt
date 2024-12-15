<?php

namespace App\Http\Controllers;

use App\Models\Definisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DefinisiController extends Controller
{
    // Tambah definisi
    public function create(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'kosakata_id' => 'required|exists:kosakata,id',
            'definisi' => 'required|min:10',
            'contoh' => '',
            'referensi' => '',
        ]);

        $arrayContoh = null;
        $arrayReferensi = null;
        if (isset($validatedData['contoh'])) {
            $arrayContoh = array_map('trim', explode(';', $validatedData['contoh']));
        }
        if (isset($validatedData['referensi'])) {
            $arrayReferensi = array_map('trim', explode(';', $validatedData['referensi']));
        }

        Definisi::create([
            'kosakata_id' => $validatedData['kosakata_id'],
            'user_id' => Auth::user()->id,
            'definisi' => $validatedData['definisi'],
            'contoh' => $arrayContoh,
            'referensi' => $arrayReferensi,
        ]);

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

        $arrayContoh = null;
        $arrayReferensi = null;
        if (isset($request->editContoh)) {
            $arrayContoh = array_map('trim', explode(';', $request->editContoh));
        }
        if (isset($request->editReferensi)) {
            $arrayReferensi = array_map('trim', explode(';', $request->editReferensi));
        }

        // Simpan
        Definisi::find($userId)->update([
            'definisi' => $validatedData['editDefinisi'],
            'contoh' => $arrayContoh,
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
