<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditKosakata extends Model
{
    //
    protected $table = 'editkosakata';
    protected $guarded = ['id'];

    protected $casts = [
        'serupa' => 'array',
        'etimologi' => 'array'
    ];
}
