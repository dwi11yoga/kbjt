<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hukuman extends Model
{
    //table
    protected $table = 'hukuman';

    protected $guarded = ['id'];

    // cast
    protected $casts = ['hukuman_berakhir' => 'datetime'];

    /**
     * Get the laporan that owns the Hukuman
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

}
