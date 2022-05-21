<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id;
 */
class Material extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function componentsMaterials(): HasMany
    {
        return $this->hasMany(ComponentMaterial::class);
    }

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class);
    }


}
