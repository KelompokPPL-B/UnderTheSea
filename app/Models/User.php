<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    public function ikans()
    {
        return $this->hasMany(Ikan::class, 'created_by');
    }

    public function ekosistems()
    {
        return $this->hasMany(Ekosistem::class, 'created_by');
    }

    public function aksiPelestariam()
    {
        return $this->hasMany(AksiPelestarian::class, 'created_by');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function updateBadge(): void
    {
        $badge = match(true) {
            $this->points >= 100 => 'Sea Guardian',
            $this->points >= 50 => 'Ocean Explorer',
            default => 'Beginner',
        };
        $this->update(['badge' => $badge]);
    }
}
