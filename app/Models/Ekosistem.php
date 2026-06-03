<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ekosistem extends Model
{
    protected $table = 'ekosistem';
    protected $primaryKey = 'id_ekosistem';

    protected $fillable = [
        'nama_ekosistem',
        'deskripsi',
        'lokasi',
        'peran',
        'ancaman',
        'gambar',
        'created_by',
    ];

    // Relasi ke User (creator)
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke Favorite
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'item_id')
                    ->where('type', 'ekosistem');
    }

    // Relasi ke UserView
    public function userViews(): HasMany
    {
        return $this->hasMany(UserView::class, 'content_id')
                    ->where('content_type', 'ekosistem');
    }

    // Helper: cek apakah user sudah bookmark ekosistem ini
    public function isFavoritedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}