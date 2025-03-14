<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;

class BannerController extends Controller
{
    // View edit banner
    public function index()
    {
        $banner = Banner::all()->keyBy('id')->toArray(); //ubah ke data jadi array
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
            }
            // validasi url
            if ((empty($request['url-' . $i]) || $request['url-' . $i] == null) && $request['url-' . $i] != $banner[$i]['link']) {
                $rules['url-' . $i] = '';
                $simpan[$i]['link'] = null;
            } elseif (isset($request['url-' . $i]) && $request['url-' . $i] != $banner[$i]['link']) {
                $rules['url-' . $i] = 'url';
                $simpan[$i]['link'] = $request['url-' . $i];
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
            // urus gambar
            if (isset($validatedData['img-' . $i])) {
                // hapus foto lama jika ada
                if (isset($banner[$i]['img'])) {
                    Storage::delete($banner[$i]['img']);
                }
                // simpan gambar
                $simpan[$i]['img'] = $request->file('img-' . $i)->store('banner');
            }

            // update data
            Banner::find($i)->update($simpan[$i] ?? []);
        }

        // kembali ke halaman banner
        return back()->with('success', 'Perubahan berhasil disimpan');
    }
}
