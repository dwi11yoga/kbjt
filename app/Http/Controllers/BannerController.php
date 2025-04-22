<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;

class BannerController extends Controller
{
    // View edit banner
    public function index()
    {
        $banner = Banner::with([
            'user' => function ($query) {
                $query->withTrashed(); //ambil data softdelete juga
            }
        ])
            ->get()
            ->keyBy('id');

        // cek apakah data user (author) ada/terhapus
        foreach ($banner as $d) {
            if (isset($d->user) && $d->user->trashed()) {
                $d->user->statusUser = 'dihapus';
            }
        }

        // dd($banner);
        // $banner=Banner::all();
        return view('dashboard.banner', [
            'title' => 'Banner',
            'group' => 'banner',
            'banner' => $banner
        ]);
    }

    // simpan edit banner
    public function store(Request $request)
    {
        // dd($request);
        $banner = Banner::all()->keyBy('id')->toArray(); //ubah ke data jadi array
        // $banner=Banner::get();

        // validasi
        $rules = [];
        $simpan = [];
        for ($i = 1; $i <= 7; $i++) {
            // validasi gambar
            if (isset($request['img-' . $i])) {
                $rules['img-' . $i] = [File::types(['jpg', 'jpeg', 'png', 'webp', 'tiff', 'bmp'])->max(1024)];
            }
            // validasi status
            if (isset($request['status-' . $i]) && $request['status-' . $i] != $banner[$i]['status']) {
                $rules['status-' . $i] = 'required';
                $simpan[$i]['status'] = $request['status-' . $i];
                $simpan[$i]['user_id'] = Auth::user()->id; // pengurus yang mengedit
            }
            // validasi url
            if ((empty($request['url-' . $i]) || $request['url-' . $i] == null) && $request['url-' . $i] != $banner[$i]['url']) {
                $rules['url-' . $i] = '';
                $simpan[$i]['url'] = null;
                $simpan[$i]['user_id'] = Auth::user()->id; // pengurus yang mengedit

            } elseif (isset($request['url-' . $i]) && $request['url-' . $i] != $banner[$i]['url']) {
                $rules['url-' . $i] = 'url';
                $simpan[$i]['url'] = $request['url-' . $i];
                $simpan[$i]['user_id'] = Auth::user()->id; // pengurus yang mengedit
            }

            // validasi hover title
            if (isset($request['hover_title-' . $i]) && $request['hover_title-' . $i] != $banner[$i]['hover_title']) {
                $rules['hover_title-' . $i] = 'required';
                $simpan[$i]['hover_title'] = $request['hover_title-' . $i];
                $simpan[$i]['user_id'] = Auth::user()->id; // pengurus yang mengedit
            }
        }

        try {
            $validatedData = $request->validate($rules);
        } catch (ValidationException $e) {
            return back()
                ->with('failed', 'Gagal menyimpan perubahan')
                ->withErrors($e->errors())
                ->withInput();
        }

        // Simpan data
        for ($i = 1; $i <= 7; $i++) {
            // urus gambar. ditaruh sini supaya validasi dijalankan dulu sebelum proses gambar
            if (isset($validatedData['img-' . $i])) {
                // hapus foto lama jika ada
                if (isset($banner[$i]['img'])) {
                    Storage::delete($banner[$i]['img']);
                }
                // simpan gambar
                $simpan[$i]['img'] = $request->file('img-' . $i)->store('banner');
                $simpan[$i]['user_id'] = Auth::user()->id; // pengurus yang mengedit
            }

            // update data
            Banner::find($i)->update($simpan[$i] ?? []);
        }

        // kembali ke halaman banner
        return back()->with('success', 'Perubahan berhasil disimpan');
    }
}
