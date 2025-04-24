<?php

namespace App\Http\Controllers;

use App\Models\EditKosakata;
use App\Models\Kosakata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditKosakataController extends Controller
{
    // View Edit kosakata
    public function edit($slug)
    {
        $data = Kosakata::where('slug', $slug)->first();

        // jika kosakat sudah diedit, maka gunakan data edit
        $editKosakata = EditKosakata::where('kosakata_id', $data->id)
            ->whereNotNull('status')
            ->orderBy('updated_at', 'desc')
            ->first();
        if (isset($editKosakata)) {
            $kosakata = $editKosakata;
            $kosakata->kosakata = $data->kosakata;
            $kosakata->slug = $data->slug;
        } else {
            $kosakata = $data;
        }

        // dd($kosakata);

        // Ubah json ke text
        if (isset($kosakata['serupa'])) {
            $kosakata['serupa'] = implode('; ', $kosakata['serupa']);
            $kosakata['serupa'] = str_replace('"', '', $kosakata['serupa']);
        }
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
                'group' => '',
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

        // Validasi
        $rules = [
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

        // simpan
        EditKosakata::create([
            'user_id' => Auth::user()->id,
            'kosakata_id' => $id->id,
            'ragam' => $validatedData['ragam'],
            'aksara' => $request->aksara,
            'jenis' => $request->jenis,
            'notasi_fonetik' => $request->notasi_fonetik,
            'arti_indo' => $request->arti_indo,
            'etimologi' => $etimologi,
            'serupa' => $arraySerupa,
            'catatan' => $request->catatan
        ]);

        // CEK ACHIEVEMENT 
        // rule yang akan dicek achievementnya
        $userId = Auth::user()->id;
        $rule = ['kosakata', 'totalViewKosakata', 'viewKosakata'];

        //lakukan perulangan untuk cek achievement user
        foreach ($rule as $d) {
            $this->achievement($userId, $d);
        }

        return redirect('/kosakata/' . $slug)->with('success', 'Permintaan edit akan segera diproses');
    }

    //setujui perubahan detail kosakata
    public function setujui($slug, $id)
    {
        // dd($id);
        $editKosakata = EditKosakata::where('id', '=', $id)->first();

        // jika sudah diacc oleh pengurus lain
        if (isset($editKosakata->status)) {
            return back()->with('failed', 'Perubahan detail kosakata telah disetujui oleh pengurus lain');
        }

        // simpan perubahan
        EditKosakata::find($id)->update([
            'status' => now(),
            'pengurus_id' => Auth::user()->id
        ]);

        // cek achievement
        $this->achievement($editKosakata->user_id, 'editKosakata');
        // dd($a);

        return back()->with('success', 'Perubahan detail kosakata disetujui');
    }
}
