<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property City cities;
 */
class State extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en'];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return $this->{'name_'.app()->getLocale()};
    }

    protected function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    protected function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
