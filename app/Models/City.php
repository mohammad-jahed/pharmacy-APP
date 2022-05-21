<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Area areas;
 */
class City extends Model
{
    use HasFactory;

    protected $fillable = ['state_id', 'name_ar', 'name_en'];
    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return $this->{'name_'.app()->getLocale()};
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
    }
}
