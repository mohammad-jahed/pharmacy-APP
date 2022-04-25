<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComponentMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'component_id',
        'material_id'
    ];

    protected function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    protected function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
