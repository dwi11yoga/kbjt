<?php

use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;



// cek notifikasi
function cekNotifikasi()
{
    // dapatkan data
    $notif = Notifikasi::where('user_id', Auth::user()->id)
        ->where('dilihat', 0)
        ->first();

    // jika $notif kosong, maka semua notifikasi sudah dibaca
    $adaNotif = isset($notif) ? true : false;

    return $adaNotif;
}