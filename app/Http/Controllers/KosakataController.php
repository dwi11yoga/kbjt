<?php

namespace App\Http\Controllers;

use App\Models\EditKosakata;
use App\Models\Kosakata;
use App\Models\PoinKontribusi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isNull;

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
        // Buat slug
        $request['slug'] = strtolower($request['kosakata']);
        $request['slug'] = str_replace(' ', '-', $request['slug']);
        // dd($request['slug']);

        $rules = [
            'kosakata' => 'required|unique:kosakata,kosakata',
            'ragam' => '',
            'slug' => 'required|unique:kosakata,slug'
        ];
        if (isset($request->bahasa)) {
            $rules['kata_diserap'] = 'required';
        }

        if (isset($request->kata_diserap)) {
            $rules['bahasa'] = 'required';
        }
        $validatedData = $request->validate($rules);

        // Buat array etimologi
        $etimologi = [""];
        if ($request->etimologi == 'Asli') {
            $etimologi = [$request->etimologi];
        } elseif (isset($request->bahasa) && isset($request->kata_diserap)) {
            $etimologi = [$request->bahasa, $request->kata_diserap];
        }

        // Membuat array serupa
        $arraySerupa = array_map('trim', explode(';', $request->serupa));

        // tambah poin
        $tambahPoin = PoinKontribusi::where('kontribusi', '=', 'Menambah kosakata')
            ->where('role', '=', Auth::user()->role)
            ->value('poin');
        if (!empty($tambahPoin)) {
            User::where('id', '=', Auth::user()->id)->increment('poin', $tambahPoin);
        }

        Kosakata::create([
            'user_id' => Auth::user()->id,
            'kosakata' => $validatedData['kosakata'],
            'slug' => $validatedData['slug'],
            'ragam' => $validatedData['ragam'],
            'aksara' => $request->aksara,
            'jenis' => $request->jenis,
            'notasi_fonetik' => $request->notasi_fonetik,
            'arti_indo' => $request->arti_indo,
            'etimologi' => $etimologi,
            'serupa' => $arraySerupa,
            'poin' => $tambahPoin ?? 0
        ]);

        return redirect('/kosakata/' . $validatedData['slug'], )->with('success', 'Kosakata berhasil ditambahkan');

    }

    // Edit kosakata
    public function edit($slug)
    {
        $kosakata = Kosakata::where('slug', $slug)->first();

        // Ubah json ke text
        $kosakata['serupa'] = implode('; ', $kosakata['serupa']);
        $kosakata['serupa'] = str_replace('"', '', $kosakata['serupa']);
        $etimologi = str_replace('"', '', $kosakata['etimologi']);
        if ($etimologi != '') {
            $etimologi = implode('; ', $kosakata['etimologi']) ?? null;
        }

        // Jika etimologi diisi dan bukan berisi "Asli"
        if ($etimologi != '' && $etimologi != "Asli") {
            $kosakata['bahasa'] = $kosakata['etimologi'][0];
            $kosakata['kata_diserap'] = $kosakata['etimologi'][1];
        } else {
            $kosakata['etimologi'] = $etimologi;
        }

        if ($kosakata != null) {
            // Jika kosakata ditemukan
            return view('homepage.edit-kosakata', [
                'title' => 'Edit kosakata',
                'data' => $kosakata
            ]);
        } else {
            // Jika kosakata tidak ditemukan
            return redirect('/kosakata/' . $slug)->with('failed', 'Kosakata yang diedit tidak ditemukan');
        }
    }

    // Simpan edit kosakata
    public function simpanEdit(Request $request, $slug)
    {
        $id = Kosakata::select('id')->where('slug', $slug)->first();

        // Buat slug
        $request['slug'] = strtolower($request->slug);

        // dd($request);

        // Validasi
        $rules = [
            'kosakata' => ['required', Rule::unique('kosakata', 'kosakata')->ignore($id->id, 'id')],
            'slug' => ['required', Rule::unique('kosakata', 'slug')->ignore($id->id, 'id')],
            'ragam' => 'required',
        ];

        if (isset($request->bahasa)) {
            $rules['kata_diserap'] = 'required';
        }

        if (isset($request->kata_diserap)) {
            $rules['bahasa'] = 'required';
        }

        $validatedData = $request->validate($rules);


        // Buat array etimologi
        $etimologi = [""];
        if ($request->etimologi == 'Asli') {
            $etimologi = [$request->etimologi];
        } elseif (isset($request->bahasa) && isset($request->kata_diserap)) {
            $etimologi = [$request->bahasa, $request->kata_diserap];
        }

        // Membuat array serupa
        $arraySerupa = array_map('trim', explode(';', $request->serupa));

        EditKosakata::create([
            'user_id' => Auth::user()->id,
            'kosakata_id' => $id->id,
            'slug' => $validatedData['slug'],
            'ragam' => $validatedData['ragam'],
            'aksara' => $request->aksara,
            'jenis' => $request->jenis,
            'notasi_fonetik' => $request->notasi_fonetik,
            'arti_indo' => $request->arti_indo,
            'etimologi' => json_encode($etimologi),
            'serupa' => json_encode($arraySerupa)
        ]);

        return redirect('/kosakata/' . $slug)->with('success', 'Permintaan edit akan segera diproses');
    }
}
