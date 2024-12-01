<?php

namespace App\Http\Controllers;

use App\Models\Kosakata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KosakataController extends Controller
{
    // View tambah kosakata
    public function tambahKosakata()
    {
        return view('homepage.buat-kosakata', [
            'title' => 'Tambah kosakata'
        ]);
    }

    // Simpan kosakata
    public function store(Request $request)
    {
        // Membuat slug
        $slug = Str::slug($request->kosakata);

        $rules = [
            'kosakata' => 'required|unique:kosakata,kosakata',
            'ragam' => 'required',
        ];
        if (isset($request->bahasa)) {
            $rules['etimologi'] = 'required';
        }

        if (isset($request->etimologi)) {
            $rules['bahasa'] = 'required';
        }
        $validatedData = $request->validate($rules);

        // Buat array etimologi
        $etimologi = [""];
        if (isset($request->bahasa) && isset($request->etimologi)) {
            $etimologi = [$request->bahasa, $request->etimologi];
        }

        // Membuat array serupa
        $arraySerupa = array_map('trim', explode(';', $request->serupa));

        Kosakata::create([
            'user_id' => Auth::user()->id,
            'kosakata' => $validatedData['kosakata'],
            'slug' => $slug,
            'ragam' => $validatedData['ragam'],
            'aksara' => $request->aksara,
            'jenis' => $request->jenis,
            'notasi_fonetik' => $request->notasi_fonetik,
            'arti_indo' => $request->arti_indo,
            'etimologi' => $etimologi,
            'serupa' => $arraySerupa,
        ]);

        return redirect('/kosakata/' . $slug, )->with('success', 'Kosakata berhasil ditambahkan');

    }
}
