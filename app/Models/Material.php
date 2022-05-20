<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['component_id', 'name_en', 'name_ar'];

    protected function ComponentsMaterials(): HasMany
    {
        return $this->hasMany(ComponentMaterial::class);
    }

}
