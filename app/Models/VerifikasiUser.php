<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifikasiUser extends Model
{
    //tabel
    protected $table='verifikasi_user';

    // lindungi id dkk agar tidak dapat diedit
    protected $guarded=['id'];
}
