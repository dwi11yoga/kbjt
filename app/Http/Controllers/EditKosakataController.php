<?php

namespace App\Http\Controllers;

use App\Models\EditKosakata;
use App\Models\Kosakata;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
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

        // cek apakah user di suspend/tidak
        $suspend = $this->cekSuspend(Auth::user()->id);

        if ($kosakata != null) {
            // Jika kosakata ditemukan
            return view('homepage.edit-kosakata', [
                'title' => 'Edit kosakata',
                'group' => '',
                'data' => $kosakata,
                'suspend' => $suspend
            ]);
        } else {
            // Jika kosakata tidak ditemukan
            return redirect('/kosakata/' . $slug)->with('failed', 'Kosakata yang diedit tidak ditemukan');
        }
    }

    // Fungsi Simpan edit kosakata
    public function simpanEdit(Request $request, $slug)
    {
        // cek apakah user kena suspend/tidak
        $suspend = $this->cekSuspend(Auth::user()->id);
        if ($suspend->hukuman == true) {
            return back()->withInput()->with('failed', 'Gagal menyimpan form edit kosakata karena akunmu sedang disuspend.');
        }

        // dapatkan id kosakata
        $kosakata = Kosakata::where('slug', $slug)->first();

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

        // PASTIKAN ADA DATA YANG DIRUBAH DARI DATA KOSAKATA TERBARU
        // jika kosakat sudah diedit, maka gunakan data edit
        $editKosakata = EditKosakata::where('kosakata_id', $kosakata->id)
            ->whereNotNull('status')
            ->orderBy('updated_at', 'desc')
            ->first();
        if (isset($editKosakata)) {
            $data = $kosakata; // simpan data kosakata sementara
            $kosakata = $editKosakata; // timpa data kosakata dengan editKosakata
            //ubah id dari kosakata agar tidak menggunakan id edit kosakata (bisa error)
            $kosakata->id = $data->id;
        }

        // cek
        if (
            $kosakata->aksara == $request->aksara &&
            $kosakata->notasi_fonetik == $request->notasi_fonetik &&
            $kosakata->ragam == $request->ragam &&
            $kosakata->jenis == $request->jenis &&
            $kosakata->serupa == $arraySerupa &&
            $kosakata->arti_indo == $request->arti_indo &&
            $kosakata->etimologi == $etimologi
        ) {
            return back()->with('failed', 'Detail kosakata yang kamu submit belum mengalami perubahan');
        }

        // data yang akan disimpan
        $simpan = [
            'user_id' => Auth::user()->id,
            'kosakata_id' => $kosakata->id,
            'ragam' => $validatedData['ragam'],
            'aksara' => $request->aksara,
            'jenis' => $request->jenis,
            'notasi_fonetik' => $request->notasi_fonetik,
            'arti_indo' => $request->arti_indo,
            'etimologi' => $etimologi,
            'serupa' => $arraySerupa,
            'catatan' => $request->catatan
        ];

        // tambahkan data yang akan disimpan jika user==pengurus
        if (Auth::user()->role == 'pengurus') {
            $simpan['pengurus_id'] = Auth::user()->id;
            $simpan['status'] = Carbon::now();
            // tambah poin
            $poin = $this->poinKontribusi(Auth::user()->id, 'Edit kosakata');
            $simpan['poin_user'] = $poin;
            $simpan['poin_pengurus'] = 0; // jika pengurus yang mensubmit, maka tidak mendapatkan poin dari menyetujui edit kosakata
        }

        // simpan
        EditKosakata::create($simpan);

        // CEK ACHIEVEMENT 
        // rule yang akan dicek achievementnya
        $userId = Auth::user()->id;
        $rule = ['kosakata', 'totalViewKosakata', 'viewKosakata'];

        //lakukan perulangan untuk cek achievement user
        foreach ($rule as $d) {
            $this->achievement($userId, $d);
        }

        if (Auth::user()->role == 'pengurus') {
            $pesan = 'Deskripsi berhasil diperbarui (+' . $poin . ' Poin)';
        } else {
            $pesan = 'Terima kasih, permintaan edit akan segera diproses';
        }

        return redirect('/kosakata/' . $slug)->with('success', $pesan);
    }

    //setujui perubahan detail kosakata
    public function setujui($slug, $id)
    {
        // dapatkan data edit kosakata
        $editKosakata = EditKosakata::find($id);

        // jika sudah diacc oleh pengurus lain
        if (isset($editKosakata->status)) {
            return back()->with('failed', 'Perubahan detail kosakata telah disetujui oleh pengurus lain');
        }

        // dapatkan poin untuk kontributor
        $poin_user = $this->poinKontribusi($editKosakata->user_id, 'Edit kosakata');
        // dapatkan poin untuk pengurus
        $poin_pengurus = $this->poinKontribusi(Auth::user()->id, 'Setujui form edit kosakata dari kontributor');

        // simpan perubahan
        EditKosakata::find($id)->update([
            'poin_user' => $poin_user,
            'pengurus_id' => Auth::user()->id,
            'poin_pengurus' => $poin_pengurus,
            'status' => now(),
        ]);

        // kirim notifikasi ke kontributor
        $kosakata = Kosakata::find($editKosakata->kosakata_id);
        $pesan = 'Deskripsi kosakata ' . strtolower($kosakata->kosakata) . ' yang kamu submit disetujui oleh pengurus (+' . $poin_user . ' Poin)';
        $url = '/kosakata/' . $kosakata->slug . '/riwayat';
        $this->kirimNotifikasi($editKosakata->user_id, 'kosakata', $pesan, $url);

        // cek achievement
        $this->achievement($editKosakata->user_id, 'editKosakata');

        return back()->with('success', 'Perubahan detail kosakata berhasil disetujui (+' . $poin_pengurus . ' Poin)');
    }
}
