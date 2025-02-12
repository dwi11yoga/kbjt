<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    //tabel database
    protected $table = 'donasi';

    // lindungi id
    protected $guarded = ['id'];
}
