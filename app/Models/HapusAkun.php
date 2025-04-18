<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HapusAkun extends Model
{
    // tabel database
    protected $table = 'akun_dihapus';

    // lindungi id
    protected $guarded=['id'];

    // relasi dengan tabel user
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

}
