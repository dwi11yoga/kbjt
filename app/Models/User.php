<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'nama',
    //     'username',
    //     'email',
    //     // 'email_verified_at',
    //     'password',
    //     'role',
    //     'tgl_lahir',
    //     'kota',
    //     'jenis_kelamin',
    //     'profile_pic',
    //     'bio',
    //     'telp',
    //     'pekerjaan',
    //     'hobi',
    //     'tampilkan_email',
    //     'media_sosial',
    //     // 'terakhir_aktif',
    //     // 'poin',
    //     // 'poin_diperbarui',
    //     'achivement'
    // ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        //konversi json jadi array
        'media_sosial' => 'array',
        'donasi' => 'array',
        'tgl_lahir' => 'datetime'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi dengan definisi
    public function definisi(): HasMany
    {
        return $this->hasMany(Definisi::class);
    }

    public function kosakata(): HasMany
    {
        return $this->hasMany(Kosakata::class);
    }
}
