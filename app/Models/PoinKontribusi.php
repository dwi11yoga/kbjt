<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoinKontribusi extends Model
{
    //
    protected $table = 'poin_kontribusi';

    // 
    protected $guarded = ['id', 'kontribusi', 'role', 'deskripsi'];
}
