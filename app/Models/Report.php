<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;
    //
    protected $guarded = ['id'];

    // Relasi dengan definisi
    /**
     * Get the definisi that owns the Report
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function definisi(): BelongsTo
    {
        return $this->belongsTo(Definisi::class);
    }

    // Relasi dengan user
    /**
     * Get the user that owns the Report
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // relasi dengan user (untuk pengurus)
    /**
     * Get the pengurus that owns the Report
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengurus(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'pengurus_id');
    }
}
