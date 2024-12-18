<?php

namespace App\Http\Controllers;

use App\Models\PoinKontribusi;
use Illuminate\Http\Request;

class PoinKontribusiController extends Controller
{
    //ViewHalaman poin kontribusi
    // ada di LevelController

    // edit poin kontribusi
    public function update(Request $request)
    {
        // dd($request);
        // validasi data
        $validatedData = $request->validate([
            'idPoinKontribusi' => 'required|integer',
            'editKontribusi' => 'required',
            'editDeskripsi' => '',
            'editPoinDiperoleh' => 'required|integer|min:1'
        ]);

        // Cek apakah id/kontribusi diedit
        $cekPoinKontribusi = PoinKontribusi::select('id')
            ->where('id', '=', $validatedData['idPoinKontribusi'])
            ->where('kontribusi', '=', $validatedData['editKontribusi'])
            ->first();

        if (empty($cekPoinKontribusi)) {
            return back()->with('failed', value: 'ID atau Kontribusi tidak boleh diedit')
                ->withErrors(['idPoinKontribusi' => 'Kontribusi atau id tidak boleh diganti'])
                ->withInput();
        }

        // simpan
        PoinKontribusi::find($validatedData['idPoinKontribusi'])->update([
            'deskripsi' => $validatedData['editDeskripsi'],
            'poin' => $validatedData['editPoinDiperoleh']
        ]);

        // kembali ke halaman
        return back()->with('success', 'Poin kontribusi berhasil diedit');
    }
}
