<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    //  nama tabel
    protected $table = "notifikasi";

    // lindungi id agar tidak bisa 
    protected $guarded=['id'];

    // relasi dengan tabel user= many to one
}
