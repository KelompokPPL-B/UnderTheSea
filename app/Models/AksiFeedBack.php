<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AksiFeedback extends Model
{
    protected $table = 'aksi_feedback';

    protected $fillable = [
        'aksi_id',
        'nama_peserta',
        'komentar',
        'session_id'
    ];

    public function aksi()
    {
        return $this->belongsTo(AksiPelestarian::class, 'aksi_id', 'id_aksi');
    }
}