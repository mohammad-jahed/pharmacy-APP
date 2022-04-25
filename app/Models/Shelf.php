<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shelf extends Model
{
    use HasFactory;

    protected $fillable = ['name_en', 'name_ar'];

    protected function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }
}
