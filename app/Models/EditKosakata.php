<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EditKosakata extends Model
{
    //
    protected $table = 'editkosakata';
    protected $guarded = ['id'];

    protected $casts = [
        'serupa' => 'array',
        'etimologi' => 'array'
    ];

    /**
     * Get the user that owns the EditKosakata
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the pengurus that owns the EditKosakata
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengurus(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengurus_id', 'id');
    }

    /**
     * Get the kosakata that owns the EditKosakata
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kosakata(): BelongsTo
    {
        return $this->belongsTo(Kosakata::class);
    }
}
