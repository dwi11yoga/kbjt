<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    //tabel
    protected $table='reset_password';

    // lindungi id agar tidak diubah-ubah
    protected $guarded=['id'];
}
