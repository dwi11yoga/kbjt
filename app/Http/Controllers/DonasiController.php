<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    //view donasi (dashboard)
    public function index()
    {
        $donasi = Donasi::orderBy('metode', 'asc')
            ->paginate(10, '*', 'kosakata')
            ->onEachSide(2);
        $jumlah = Donasi::count();
        return view('dashboard.donasi', [
            'title' => 'Donasi',
            'group' => 'donasi',
            'donasi' => $donasi,
            'jumlah' => $jumlah
        ]);
    }

    // buat donasi
    public function tambah()
    {
        return view('dashboard.donasi-buat', [
            'title' => 'Tambah metode donasi',
            'group' => 'donasi'
        ]);
    }

    // save buat donasi
    public function save(Request $request)
    {
        // validasi
        $rules = [
            'metode' => 'required|min:3|unique:donasi,metode',
        ];

        if (isset($request->rekening)) {
            $rules['rekening'] = 'required|min_digits:6';
            if (isset($request->link)) {
                $rules['link'] = 'required|url';
            } else {
                $rules['link'] = '';
            }
        } else {
            $rules['link'] = 'required|url';
            $rules['rekening'] = '';
        }
        $validatedData = $request->validate($rules);

        // simpan
        Donasi::create([
            'metode' => $validatedData['metode'],
            'rekening' => $validatedData['rekening'],
            'url' => $validatedData['link'],
            // 'barcode'=>$validatedData['barcode'],
            'cara_donasi' => $request->cara_donasi,
        ]);

        // kembalikan ke halaman donasi
        return redirect()->to('/metode-donasi')->with('success', 'Metode donasi berhasil disimpan');
    }

    // edit donasi
    public function edit($id)
    {
        // dapatkan data donasi
        $donasi = Donasi::find($id);
        // dd($donasi);
        // view halaman
        return view('dashboard.donasi-edit', [
            'title' => 'Edit metode donasi',
            'group' => 'donasi',
            'donasi' => $donasi
        ]);
    }

    // store edit
    public function store(Request $request, $id)
    {
        // validasi
        $rules = [
            'metode' => 'required|min:3|unique:donasi,metode,' . $id . ',id',
        ];

        if (isset($request->rekening)) {
            $rules['rekening'] = 'required|min_digits:6';
            if (isset($request->link)) {
                $rules['link'] = 'required|url';
            } else {
                $rules['link'] = '';
            }
        } else {
            $rules['link'] = 'required|url';
            $rules['rekening'] = '';
        }
        $validatedData = $request->validate($rules);

        // simpan perubahan
        Donasi::find($id)->update([
            'metode' => $validatedData['metode'],
            'rekening' => $validatedData['rekening'],
            'url' => $validatedData['link'],
            // 'barcode'=>$validatedData['barcode'],
            'cara_donasi' => $request->cara_donasi,
        ]);

        // kembali ke halaman donasi
        return redirect()->to('/metode-donasi')->with('success', 'Perubahan metode donasi berhasil disimpan');
    }
}
