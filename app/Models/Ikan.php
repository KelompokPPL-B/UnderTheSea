<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ikan extends Model
{
    protected $table = 'ikan';
    protected $primaryKey = 'id_ikan';

    protected $fillable = [
        'nama',
        'deskripsi',
        'habitat',
        'karakteristik',
        'status_konservasi',
        'fakta_unik',
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
                    ->where('type', 'ikan');
    }

    // Relasi ke UserView
    public function userViews(): HasMany
    {
        return $this->hasMany(UserView::class, 'content_id')
                    ->where('content_type', 'ikan');
    }

    // Helper: cek apakah user sudah bookmark ikan ini
    public function isFavoritedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}