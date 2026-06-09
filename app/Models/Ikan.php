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

        // English aliases/attributes
        'name',
        'scientific_name',
        'description',
        'diet',
        'size',
        'conservation_status',
        'image',
    ];

    // Alias supaya kode/view lama yang pakai English tetap aman
    public function getNameAttribute()
    {
        return $this->attributes['nama'] ?? null;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nama'] = $value;
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['deskripsi'] ?? null;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['deskripsi'] = $value;
    }

    public function getImageAttribute()
    {
        return $this->attributes['gambar'] ?? null;
    }

    public function setImageAttribute($value)
    {
        $this->attributes['gambar'] = $value;
    }

    public function getConservationStatusAttribute()
    {
        return $this->attributes['status_konservasi'] ?? null;
    }

    public function setConservationStatusAttribute($value)
    {
        $this->attributes['status_konservasi'] = $value;
    }

    // Relasi ke User pembuat data
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

    // Cek apakah user sudah bookmark ikan ini
    public function isFavoritedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $this->favorites()
                    ->where('user_id', $user->id)
                    ->exists();
    }
}