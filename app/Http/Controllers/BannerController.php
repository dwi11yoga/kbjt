<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::all()->keyBy('id')->toArray(); //ubah ke data jadi array
        // dd($banner);
        return view('dashboard.banner', [
            'title' => 'Banner',
            'group' => 'banner',
            'banner' => $banner
        ]);
    }
}
