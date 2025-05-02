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
        // validasi data
        $validatedData = $request->validate([
            'idPoinKontribusi' => 'required|integer',
            'editPoinDiperoleh' => 'required|integer|min:1'
        ]);

        // simpan
        PoinKontribusi::find($validatedData['idPoinKontribusi'])->update([
            'poin' => $validatedData['editPoinDiperoleh']
        ]);

        // kembali ke halaman
        return back()->with('success', 'Poin kontribusi berhasil diedit');
    }
}
