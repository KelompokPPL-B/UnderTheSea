<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
