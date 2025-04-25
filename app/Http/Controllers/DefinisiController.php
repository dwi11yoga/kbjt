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
    // Tambah definisi
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'kosakata_id' => 'required|exists:kosakata,id',
            'definisi' => 'required|min:10',
            'referensi' => '',
        ]);

        $arrayReferensi = null;
        if (isset($validatedData['referensi'])) {
            $arrayReferensi = array_map('trim', explode(';', $validatedData['referensi']));
        }

        // tambah poin
        $tambahPoin = PoinKontribusi::where('kontribusi', '=', 'Menambah definisi')
            ->where('role', '=', Auth::user()->role)
            ->value('poin');
        if (!empty($tambahPoin)) {
            User::where('id', '=', Auth::user()->id)->increment('poin', $tambahPoin);
        }

        // simpan
        Definisi::create([
            'kosakata_id' => $validatedData['kosakata_id'],
            'user_id' => Auth::user()->id,
            'definisi' => $validatedData['definisi'],
            'referensi' => $arrayReferensi,
            'poin' => $tambahPoin ?? 0
        ]);

        // cek achievement
        $jumlahDefinisi = Definisi::where('user_id', '=', Auth::user()->id)->count();
        $this->achievement(Auth::user()->id, 'definisi');

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

        $arrayReferensi = null;
        if (isset($request->editReferensi)) {
            $arrayReferensi = array_map('trim', explode(';', $request->editReferensi));
        }

        // Simpan
        Definisi::find($userId)->update([
            'definisi' => $validatedData['editDefinisi'],
            'referensi' => $arrayReferensi,
            'verifikasi'=> null,
            'verifikasi_oleh'=>null,
            'hukuman_edit' => null,
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

    // Verifikasi laporan
    public function verifikasi($kosakata_slug, $id)
    {
        // jika user != pengurus, maka alihkan ke halaman 403
        if (Auth::user()->role != 'pengurus') {
            return $this->error403();
        }

        // simpan verifikasi
        Definisi::find($id)->update([
            'verifikasi' => Carbon::now(),
            'verifikasi_oleh' => Auth::user()->id,
        ]);

        // buat notifikasi untuk author
        $pesan='Definisi yang kamu submit untuk kosakata '.Kosakata::where('slug', $kosakata_slug)->first()->kosakata.' telah lolos verifikasi oleh admin 🤝';
        $url='/kosakata/'.$kosakata_slug.'?definisi='.$id;
        $this->kirimNotifikasi(Definisi::find($id)->user_id, 'definisi', $pesan, $url);

        // tambah poin pengurus
        $this->poinKontribusi(Auth::user()->id, 4);

        // kembali ke view
        return redirect($url)->with('success','Definisi berhasil diverifikasi');
    }
}
