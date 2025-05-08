<?php

namespace App\Http\Controllers;

use App\Models\Definisi;
use App\Models\Kosakata;
use App\Models\PoinKontribusi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DefinisiController extends Controller
{
    // fungsi Tambah definisi baru
    public function create(Request $request)
    {
        // cek apakah user kena suspend/tidak
        $suspend = $this->cekSuspend(Auth::user()->id);
        if ($suspend->hukuman == true) {
            return back()->withInput()->with('failed', 'Gagal menambahkan definisi baru karena akunmu sedang disuspend.');
        }

        // validasi
        try {
            $validatedData = $request->validate([
                'kosakata_id' => 'required|exists:kosakata,id',
                'definisi' => 'required',
                'referensi' => '',
                'bahasa' => 'required|in:jawa,indonesia'
            ]);
        } catch (ValidationException $validationException) {
            return back()->withErrors($validationException->validator)->withInput()->with('failed', 'Gagal menyimpan definisi');
        }
        $validatedData = $request->validate([
            'kosakata_id' => 'required|exists:kosakata,id',
            'definisi' => 'required|string|min:10',
            'referensi' => '',
            'bahasa' => 'required|in:jawa,indonesia'
        ]);

        // Cek apakah user sudah mensubmit definisi dengan bahasa tersebut/belum
        $cek = Definisi::where('user_id', Auth::user()->id)
            ->where('bahasa', $validatedData['bahasa'])
            ->exists();
        if ($cek == true) {
            return back()
                ->withInput()
                ->withErrors(['bahasa' => "Kamu sudah men-submit definisi dalam bahasa ini"])
                ->with('failed', 'Gagal menyimpan definisi');
            ;
        }

        $arrayReferensi = null;
        if (isset($validatedData['referensi'])) {
            $arrayReferensi = array_map('trim', explode(';', $validatedData['referensi']));
        }

        // tambah poin user
        $poin = $this->poinKontribusi(Auth::user()->id, 'Tambah definisi');

        // simpan
        $simpan = Definisi::create([
            'kosakata_id' => $validatedData['kosakata_id'],
            'user_id' => Auth::user()->id,
            'definisi' => $validatedData['definisi'],
            'referensi' => $arrayReferensi,
            'poin_kontributor' => $poin,
            'bahasa' => $validatedData['bahasa'],
        ]);

        // cek achievement
        $this->achievement(Auth::user()->id, 'definisi');

        // kembalikan view
        // dapatkan slug kosakata
        $slug = Kosakata::find($validatedData['kosakata_id'])->slug;
        return redirect()->to('/kosakata/' . $slug . '?definisi=' . $simpan->id)->with('success', 'Definisi berhasil ditambahkan (+' . $poin . ' poin)');
    }

    // Simpan edit definisi
    public function update(Request $request, $slug, $definisiId)
    {
        // cek apakah user kena suspend/tidak
        $suspend = $this->cekSuspend(Auth::user()->id);
        if ($suspend->hukuman == true) {
            return back()->withInput()->with('failed', 'Gagal mengedit definisi karena akunmu sedang disuspend.');
        }

        // Validasi
        try {
            $validatedData = $request->validate([
                'editDefinisi' . $definisiId => 'required', // menggunakan .* agar semua yang awalannya editDefinisi menggunakan validasi yang sama
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

        // dd($validatedData);

        // Simpan
        Definisi::find($definisiId)->update([
            'definisi' => $validatedData['editDefinisi' . $definisiId],
            'referensi' => $arrayReferensi,
            'verifikasi' => null,
            'verifikasi_oleh' => null,
            'hukuman_edit' => null,
        ]);

        return back()->with('success', 'Definisi berhasil diedit');
    }

    // Hapus definisi
    public function delete($slug, $definisiId)
    {
        // cek apakah user kena suspend/tidak
        $suspend = $this->cekSuspend(Auth::user()->id);
        if ($suspend->hukuman == true) {
            return back()->withInput()->with('failed', 'Gagal mengedit definisi karena akunmu sedang disuspend.');
        }

        // Cek apakah definisi benar-benar milik user
        $definisi = Definisi::select('id', 'user_id')->where('id', '=', $definisiId)->first();
        if (isset($definisi) && $definisi['user_id'] != Auth::user()->id ?? 0) {
            return back()->with('failed', 'Gagal menghapus definisi');
        }
        // hapus definisi
        Definisi::destroy($definisiId);
        return back()->with('success', 'Definisi berhasil dihapus');

    }

    // Verifikasi dan unverifikasi laporan
    public function verifikasi($kosakata_slug, $id)
    {
        // jika user != pengurus, maka alihkan ke halaman 403
        if (Auth::user()->role != 'pengurus') {
            return $this->error403();
        }

        // dapatkan data definisi
        $definisi = Definisi::with('user')
            ->with('kosakata')
            ->find($id);

        if (empty($definisi->verifikasi)) { // jika belum diverifikasi, maka verifikasi
            $verifikasi = Carbon::now();
            $verifikasi_oleh = Auth::user()->id;

            // tambah poin
            // kotnributor
            $poin_verifikasi = $this->poinKontribusi($definisi->user_id, 'Definisi terverifikasi');
            // pengurus
            $poin_pengurus = $this->poinKontribusi(Auth::user()->id, 'Verifikasi definisi');

            // atur pesan yang akan dikirimkan
            $notif = 'Definisi yang kamu submit untuk kosakata ' . $definisi->kosakata->kosakata . ' telah lolos verifikasi oleh pengurus (+' . $poin_verifikasi . ' poin)';
            $toast = 'Definisi berhasil diverifikasi (+' . $poin_pengurus . ' Poin)';
        } else { // jika sudah diverifikasi, maka unverifikasi
            $verifikasi = null;
            $verifikasi_oleh = null;

            // Atur poin menjadi 0
            $poin_verifikasi = 0;
            $poin_pengurus = 0;


            // atur pesan yang akan dikirimkan
            $notif = 'Status verifikasi untuk definisi yang kamu submit untuk kosakata ' . $definisi->kosakata->kosakata . ' telah dicabut oleh pengurus (-' . $definisi->poin_verifikasi . ' poin)';
            if (Auth::user()->id == $definisi->verifikasi_oleh) { // tambahkan poin yang dikurang jika user yang meng-unverifikasi adalah yang memverifikasi
                $toast = 'Definisi berhasil di un-verifikasi (-' . $definisi->poin_pengurus . ' poin)';
            } else {
                $toast = 'Definisi berhasil di un-verifikasi';
            }

            // kurangi poin yang dimiliki oleh kontributor dan pengurus
            // kontributor
            User::find($definisi->user_id)->decrement('poin', $definisi->poin_verifikasi);
            // pengurus
            User::find($definisi->verifikasi_oleh)->decrement('poin', $definisi->poin_pengurus);
        }

        // simpan verifikasi/unverifikasi
        Definisi::find($id)->update([
            'verifikasi' => $verifikasi,
            'verifikasi_oleh' => $verifikasi_oleh,
            'poin_verifikasi' => $poin_verifikasi,
            'poin_pengurus' => $poin_pengurus
        ]);

        // buat notifikasi untuk author
        $url = '/kosakata/' . $kosakata_slug . '?definisi=' . $id;
        $this->kirimNotifikasi($definisi->user_id, 'definisi', $notif, $url);

        if (!empty($definisi->verifikasi_oleh && Auth::user()->id != $definisi->verifikasi_oleh)) { // kirim notif untuk peng-verifikasi jika definisinya di-unverifikasi
            $notif = 'Definisi yang kamu verifikasi milik ' . $definisi->user->nama . ' pada kosakata ' . $definisi->kosakata->kosakata . ' telah di-unverifikasi oleh ' . Auth::user()->nama . ' (-' . $definisi->poin_verifikasi . ' poin)';
            $this->kirimNotifikasi($definisi->verifikasi_oleh, 'definisi', $notif, $url);
        }

        // kembali ke view
        return redirect($url)->with('success', $toast);
    }
}
