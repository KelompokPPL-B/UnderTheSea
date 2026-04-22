<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ikan extends Model
{
    protected $table = 'ikan';
    protected $primaryKey = 'id_ikan';

    /**
     * Expose English attribute names for forms and controllers.
     * The database columns remain in Indonesian; use accessors/mutators
     * to map `name` -> `nama`, `description` -> `deskripsi`, `image` -> `gambar`.
     */
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    // Accessors and mutators to map English attributes to DB columns
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

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
