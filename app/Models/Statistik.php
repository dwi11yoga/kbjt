<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    //definisikan table
    protected $table='statistik';

    // lindungi id agar tidak dapat diubah
    protected $guarded=['id'];
}
