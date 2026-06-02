<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'lokasi',
        'tanggal_kegiatan',
        'tujuan_konservasi',
        'isu_lingkungan',
        'volunteer_dibutuhkan',
        'dampak_aksi'
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'is_user_generated' => 'boolean'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'action_id', 'id_aksi');
    }

    public function tandai()
    {
        return $this->hasMany(AksiTandai::class, 'aksi_id', 'id_aksi');
    }

    /**
     * Relasi ke feedback ulasan aksi pelestarian (Grace Magaretha Sirait)
     */
    public function feedback()
    {
        return $this->hasMany(AksiFeedback::class, 'aksi_id', 'id_aksi')->orderBy('created_at', 'desc');
    }
}