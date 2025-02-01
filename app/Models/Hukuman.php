<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hukuman extends Model
{
    //table
    protected $table = 'hukuman';
    protected $guarded = ['id'];
    protected $casts = ['hukuman_berakhir' => 'datetime'];
}
