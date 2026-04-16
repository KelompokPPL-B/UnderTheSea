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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getItem()
    {
        return match ($this->type) {
            'ikan' => Ikan::find($this->item_id),
            'ekosistem' => Ekosistem::find($this->item_id),
            'aksi' => AksiPelestarian::find($this->item_id),
            default => null,
        };
    }
}
