<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    protected $table = 'favorites';
    protected $primaryKey = 'id_favorite';

    protected $fillable = [
        'user_id',
        'type',
        'item_id',
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Resolve item berdasarkan type (polymorphic-style manual)
    public function getItem(): Model|null
    {
        return match ($this->type) {
            'ikan'      => Ikan::find($this->item_id),
            'ekosistem' => Ekosistem::find($this->item_id),
            'aksi'      => AksiPelestarian::find($this->item_id),
            default     => null,
        };
    }

    // Scope: filter berdasarkan type
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}