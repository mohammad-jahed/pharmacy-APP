<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @property int pharmacy_id;
 * @property int shelf_id;
 * @property int company_id;
 * @property int alternative_id;
 * @property int id;
 * @property void alternatives;
 * @property void users;
 * @property string name;
 * @property void medicineUser;
 * @property void materials;
 */
class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shelf_id',
        'company_id',
        'alternative_id',
        'material_id',
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

    public function alternativeMedicines(): HasMany
    {
        return $this->hasMany(AlternativeMedicine::class);
    }

    public function materials() : BelongsToMany{
        return $this->belongsToMany(Material::class,'material_medicines','medicine_id','material_id')->as('material_medicine');
    }

    public function materialMedicine():HasMany{
        return $this->hasMany(MaterialMedicine::class);
    }


    public function alternatives(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class, 'alternative_medicines', 'medicine_id', 'alternative_id')->as('alternative_medicine');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'medicine_users','medicine_id','pharmacy_id')->as('medicine user');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }


}
