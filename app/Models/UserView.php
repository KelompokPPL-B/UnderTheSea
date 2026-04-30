<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id_like';

    protected $fillable = [
        'user_id',
        'action_id',
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke AksiPelestarian
    public function aksiPelestarian(): BelongsTo
    {
        return $this->belongsTo(AksiPelestarian::class, 'action_id', 'id_aksi');
    }
}