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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function aksiPelestarian(): BelongsTo
    {
        return $this->belongsTo(AksiPelestarian::class, 'action_id', 'id_aksi');
    }
}
