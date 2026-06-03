<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AksiTandai extends Model
{
    /**
     * Owner: [Grace Magaretha Sirait]
     * PBI-26: Mark Completed Action
     */

    protected $table = 'aksi_tandai';

    protected $fillable = [
        'aksi_id',
        'nama_peserta',
        'session_id',
        'ditandai_pada',
    ];

    protected $casts = [
        'ditandai_pada' => 'datetime',
    ];

    public function aksi(): BelongsTo
    {
        return $this->belongsTo(AksiPelestarian::class, 'aksi_id', 'id_aksi');
    }
}