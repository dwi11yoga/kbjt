<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donasi extends Model
{
    use HasFactory, SoftDeletes;

    //tabel database
    protected $table = 'donasi';

    // lindungi id
    protected $guarded = ['id'];
}
