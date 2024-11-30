<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Definisi extends Model
{
    use SoftDeletes;

    protected $table = 'definisi';
    protected $guarded = ['id'];
    protected $casts = [
        'verifikasi' => 'array',
        'contoh' => 'array',
        'referensi' => 'array'
    ];

    // relasi dengan user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
