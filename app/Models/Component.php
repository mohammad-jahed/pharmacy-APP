<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Component extends Model
{
    use HasFactory;

    protected $fillable = ['medicine_id', 'name_en', 'name_ar'];

    protected function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    protected function ComponentsMaterials(): HasMany
    {
        return $this->hasMany(ComponentMaterial::class);
    }

}
