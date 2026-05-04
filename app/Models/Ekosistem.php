<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'karakteristik',
        'manfaat',
        'cara_pelestarian',
        'created_by',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
