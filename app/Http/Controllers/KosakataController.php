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
        // dapatkan data banner
        $banner=$this->getBanner([1,2]);

        return view('homepage.buat-kosakata', [
            'title' => 'Tambah kosakata',
            'group'=>null,
            'banner'=>$banner
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
            'poin' => $tambahPoin ?? 0
        ]);

        // cek achievement
        $userId = Auth::user()->id;
        // jumlah kosakata
        $value = Kosakata::where('user_id', '=', $userId)->count() ?? 0; // jumlah kosakata
        $this->achievement(Auth::user()->id, 'kosakata', $value);

        // cek achievement view kosakata
        $value = Kosakata::where('user_id', '=', $userId)->orderBy('view', 'desc')->value('view') ?? 0;
        $this->achievement($userId, 'viewKosakata', $value);

        // cek achievement total view kosakata
        $value = Kosakata::where('user_id', '=', $userId)->sum('view') ?? 0;
        $this->achievement($userId, 'totalViewKosakata', $value);

        return redirect('/kosakata/' . $validatedData['slug'], )->with('success', 'Kosakata berhasil ditambahkan');

    }
}
