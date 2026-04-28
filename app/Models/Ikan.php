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
        'scientific_name',
        'habitat',
        'description',
        'diet',
        'size',
        'conservation_status',
        'image',
        'created_by',
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

    public function getScientificNameAttribute()
    {
        return $this->attributes['scientific_name'] ?? null;
    }

    public function setScientificNameAttribute($value)
    {
        $this->attributes['scientific_name'] = $value;
    }

    public function getHabitatAttribute()
    {
        return $this->attributes['habitat'] ?? null;
    }

    public function setHabitatAttribute($value)
    {
        $this->attributes['habitat'] = $value;
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['deskripsi'] ?? null;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['deskripsi'] = $value;
    }

    public function getDietAttribute()
    {
        return $this->attributes['diet'] ?? null;
    }

    public function setDietAttribute($value)
    {
        $this->attributes['diet'] = $value;
    }

    public function getSizeAttribute()
    {
        return $this->attributes['size'] ?? null;
    }

    public function setSizeAttribute($value)
    {
        $this->attributes['size'] = $value;
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

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
