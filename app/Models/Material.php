<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id;
 * @property void medicines;
 * @property void componentMaterials;
 * @property string material_name;
 *
 */
class Material extends Model
{
    use HasFactory;

    protected $fillable = ['material_name'];

    public function materialMedicine(): HasMany
    {
        return $this->hasMany(MaterialMedicine::class);
    }

    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class, 'material_medicines', 'material_id', 'medicine_id')->as('material_medicine');
    }


}
