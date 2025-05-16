<?php

namespace App\Http\Controllers;

use App\Models\PoinKontribusi;
use Illuminate\Http\Request;

class PoinKontribusiController extends Controller
{
    public function __construct(){
        // increment kunjungan di statistik jika user hari ini baru mengunjungi halaman web (berdasarkan cookie)
        $this->statKunjungan();
    }

    // fungsi edit poin kontribusi
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
