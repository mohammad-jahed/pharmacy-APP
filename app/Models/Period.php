<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property void reservations;
 */
class Period extends Model
{
    use HasFactory;

    protected $fillable = ['name_en', 'name_ar'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
