<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shelf_id',
        'company_id',
        'quantity',
        'pills',
        'expiration_date',
        'c_price',
        'price'
    ];

    protected function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    protected function shelf(): BelongsTo
    {
        return $this->belongsTo(Shelf::class);
    }

    protected function pharmacy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function medicineUser(): HasMany
    {
        return $this->hasMany(MedicineUser::class);
    }

    protected function alternativeMedicine(): HasMany
    {
        return $this->hasMany(AlternativeMedicine::class, 'alternative_id');
    }

    protected function components(): HasMany
    {
        return $this->hasMany(Component::class);
    }
}
