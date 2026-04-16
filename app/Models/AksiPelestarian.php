<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AksiPelestarian extends Model
{
    protected $table = 'aksi_pelestarian';
    protected $primaryKey = 'id_aksi';

    protected $fillable = [
        'judul_aksi',
        'deskripsi',
        'manfaat',
        'cara_melakukan',
        'gambar',
        'created_by',
        'is_user_generated',
    ];

    protected $casts = [
        'is_user_generated' => 'boolean',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'action_id', 'id_aksi');
    }
}
