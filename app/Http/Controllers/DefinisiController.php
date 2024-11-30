<?php

namespace App\Http\Controllers;

use App\Models\Definisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefinisiController extends Controller
{
    public function create(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'kosakata_id' => 'required|exists:kosakata,id',
            'definisi' => 'required|min:10',
            'contoh' => '',
            'referensi' => '',
        ]);

        $arrayContoh = array_map('trim', explode(';', $validatedData['contoh']));
        $arrayReferensi = array_map('trim', explode(';', $validatedData['referensi']));

        Definisi::create([
            'kosakata_id' => $validatedData['kosakata_id'],
            'user_id' => Auth::user()->id,
            'definisi' => $validatedData['definisi'],
            'contoh' => $arrayContoh,
            'referensi' => $arrayReferensi,
        ]);

        return back()->with('success', 'Definisi berhasil ditambahkan');
    }
}
