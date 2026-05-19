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
        'lokasi',
        'tanggal_kegiatan',
        'tujuan_konservasi',
        'isu_lingkungan',
        'volunteer_dibutuhkan',
        'dampak_aksi',
        'gambar',
        'created_by',
        'is_user_generated',
    ];

    protected $casts = [
        'is_user_generated'   => 'boolean',
        'tanggal_kegiatan'    => 'date',
        'volunteer_dibutuhkan' => 'integer',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'action_id', 'id_aksi');
    }

    /**
     * =====================================================
     * ===== MARK ACTION SECTION (PBI-26) =====
     * =====================================================
     * Relasi ke model AksiTandai (Satu aksi bisa ditandai banyak session/user)
     */
    public function tandai(): HasMany
    {
        // Parameter 1: Class target (AksiTandai)
        // Parameter 2: Foreign key di tabel aksi_tandai (aksi_id)
        // Parameter 3: Local key di tabel aksi_pelestarian (id_aksi)
        return $this->hasMany(AksiTandai::class, 'aksi_id', 'id_aksi');
    }
}