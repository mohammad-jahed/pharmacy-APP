<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id;
 */
class Shelf extends Model
{
    use HasFactory;

    protected $fillable = ['shelf_name'];

    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }
}
