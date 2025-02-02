<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Report extends Model
{
    use HasFactory;
    //
    protected $guarded = ['id'];

    protected $casts = [
        'ref_dilaporkan' => 'array',
        'waktu_definisi' => 'datetime',
        'status' => 'datetime'
    ];

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
        return $this->belongsTo(User::class, 'pengurus_id', 'id');
    }

    /**
     * Get the hukuman associated with the Report
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hukuman(): HasOne
    {
        return $this->hasOne(Hukuman::class, 'laporan_id');
    }

    /**
     * Get the kosakata that owns the Report
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kosakata(): BelongsTo
    {
        return $this->belongsTo(Kosakata::class);
    }
}
