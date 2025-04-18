<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonasiController extends Controller
{
    //view donasi (dashboard)
    public function index()
    {
        $donasi = Donasi::orderBy('metode', 'asc')
            ->paginate(10, '*', 'kosakata')
            ->onEachSide(2);
        $jumlah = Donasi::count(); //jumlah metode donasi
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

        // diantara rekening atau link harus ada yang diisi salah satu
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

        // cek apakah barcode diisi/tidak
        if ($request->barcode) {
            $rules['barcode'] = 'mimes:png,jpg,jpeg,webp|image|max:1024|dimensions:ratio=1/1';
        }

        $validatedData = $request->validate($rules);

        // SIMPAN

        // tampung data yang akan disimpan
        $data = [
            'metode' => $validatedData['metode'],
            'rekening' => $validatedData['rekening'],
            'url' => $validatedData['link'],
            'cara_donasi' => $request->cara_donasi,
        ];

        // simpan gambar ke storage
        if (isset($request->barcode)) {
            $barcode = $request->file('barcode')->store('donation-barcode');
            $data['barcode'] = $barcode; //mengembalikan path dimana file disimpan
        }

        // simpan 
        Donasi::create($data);

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

        // diantara rekening atau link harus ada yang diisi salah satu
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


        // cek apakah barcode diisi/tidak
        if ($request->barcode) {
            $rules['barcode'] = 'mimes:png,jpg,jpeg,webp|image|max:1024|dimensions:ratio=1/1';
        }

        $validatedData = $request->validate($rules);

        // SIMPAN PERUBAHAN

        $data = [
            'metode' => $validatedData['metode'],
            'rekening' => $validatedData['rekening'],
            'url' => $validatedData['link'],
            // 'barcode'=>$validatedData['barcode'],
            'cara_donasi' => $request->cara_donasi,
        ];

        // atasi barcode
        if (isset($request->barcode)) {
            // hapus barcode (jika ada)
            $donasi = Donasi::where('id', $id)->value('barcode');
            if (isset($donasi)) {
                Storage::delete($donasi);
            }

            // simpan barcode baru ke storage
            $barcode=$request->file('barcode')->store('donation-barcode');
            $data['barcode']=$barcode; // $barcode berisi path barcode disimpan
        }

        // simpan
        Donasi::find($id)->update($data);

        // kembali ke halaman donasi
        return redirect()->to('/metode-donasi')->with('success', 'Perubahan metode donasi berhasil disimpan');
    }

    // fungsi delete metode - belom
}
