<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ComponentMaterial extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'component_id',
        'material_id'
    ];

    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

}
