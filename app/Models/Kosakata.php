<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kosakata extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $casts = [
        'diedit_oleh' => 'array',
        'serupa' => 'array'
    ];
}
