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
        // cek apakah user disuspend/tidak
        $suspend=$this->cekSuspend(Auth::user()->id);
        // dapatkan data banner
        $banner = $this->getBanner([1, 2]);

        return view('homepage.buat-kosakata', [
            'title' => 'Tambah kosakata',
            'group' => null,
            'banner' => $banner,
            'suspend'=>$suspend
        ]);
    }

    // fungsi Simpan kosakata
    public function store(Request $request)
    {
        // cek apakah user kena suspend/tidak
        $suspend = $this->cekSuspend(Auth::user()->id);
        if ($suspend->hukuman==true) {
            return back()->withInput()->with('failed', 'Gagal menambahkan kosakata baru karena akunmu sedang disuspend.');
        }

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
        $poin = $this->poinKontribusi(Auth::user()->id, "Tambah kosakata");

        // simpan
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
            'poin' => $poin
        ]);

        // cek achievement
        $userId = Auth::user()->id;
        // rule yang akan dicek achievementnya
        $rule = ['kosakata', 'totalViewKosakata', 'viewKosakata'];
        //lakukan perulangan untuk cek achievement user
        foreach ($rule as $d) {
            $this->achievement($userId, $d);
        }

        return redirect('/kosakata/' . $validatedData['slug'], )
            ->with('success', 'Kosakata berhasil ditambahkan (+' . $poin . ' Poin)');

    }
}
