<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'state_id',
        'city_id',
        'area_id',
        'street'
    ];

    protected function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    protected function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    protected function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
