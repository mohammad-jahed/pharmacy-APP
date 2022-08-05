<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * @property int id;
 * @method static self firstOrCreate(array $array)
 */
class Shelf extends Model
{
    use HasFactory;

    protected $fillable = [
        'shelf_name',
    ];

    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class, 'medicine_shelves', 'shelf_id', 'medicine_id')->as('medicine_shelf');
    }
}
