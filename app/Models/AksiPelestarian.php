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

    // Relasi ke User (creator)
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke Like
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'action_id', 'id_aksi');
    }

    // Relasi ke Favorite
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'item_id')
                    ->where('type', 'aksi');
    }

    // Relasi ke UserView
    public function userViews(): HasMany
    {
        return $this->hasMany(UserView::class, 'content_id')
                    ->where('content_type', 'aksi');
    }

    // Helper: cek apakah user sudah like aksi ini
    public function isLikedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // Helper: cek apakah user sudah bookmark aksi ini
    public function isFavoritedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}