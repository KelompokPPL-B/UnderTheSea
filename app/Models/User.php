<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'points', 'badge'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ===== RELASI KE KONTEN =====

    public function ikans()
    {
        return $this->hasMany(Ikan::class, 'created_by');
    }

    public function ekosistems()
    {
        return $this->hasMany(Ekosistem::class, 'created_by');
    }

    // FIX: typo 'aksiPelestariam' -> 'aksiPelestarians'
    public function aksiPelestarians()
    {
        return $this->hasMany(AksiPelestarian::class, 'created_by');
    }

    // ===== RELASI KE INTERAKSI =====

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    public function userViews()
    {
        return $this->hasMany(UserView::class, 'user_id');
    }

    // ===== MANY-TO-MANY via Favorite (polymorphic-style) =====

    public function favoritedIkan()
    {
        return $this->hasManyThrough(
            Ikan::class,
            Favorite::class,
            'user_id',   // FK di favorites
            'id_ikan',   // FK di ikan
            'id',        // PK di users
            'item_id'    // kolom di favorites yang nyimpan id ikan
        )->where('favorites.type', 'ikan');
    }

    public function favoritedEkosistem()
    {
        return $this->hasManyThrough(
            Ekosistem::class,
            Favorite::class,
            'user_id',
            'id_ekosistem',
            'id',
            'item_id'
        )->where('favorites.type', 'ekosistem');
    }

    public function favoritedAksi()
    {
        return $this->hasManyThrough(
            AksiPelestarian::class,
            Favorite::class,
            'user_id',
            'id_aksi',
            'id',
            'item_id'
        )->where('favorites.type', 'aksi');
    }

    // ===== HELPER METHODS =====

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function updateBadge(): void
    {
        $badge = match(true) {
            $this->points >= 100 => 'Sea Guardian',
            $this->points >= 50  => 'Ocean Explorer',
            default              => 'Beginner',
        };
        $this->update(['badge' => $badge]);
    }
}