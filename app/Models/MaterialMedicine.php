<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialMedicine extends Model
{
    use HasFactory;

    protected $fillable = ['material_id', 'medicine_id'];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
