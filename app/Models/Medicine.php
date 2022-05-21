<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int pharmacy_id;
 *
 */
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

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function shelf(): BelongsTo
    {
        return $this->belongsTo(Shelf::class);
    }

    public function medicineUser(): HasMany
    {
        return $this->hasMany(MedicineUser::class);
    }

    public function alternativeMedicine(): HasMany
    {
        return $this->hasMany(AlternativeMedicine::class, 'alternative_id');
    }

    public function components(): HasMany
    {
        return $this->hasMany(Component::class);
    }
}
