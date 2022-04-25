<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pharmacy_id', 'period'];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function pharmacy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'pharmacy_id');
    }

    protected function reservationUser(): HasMany
    {
        return $this->hasMany(ReservationUser::class);
    }

    protected function medicineReservation(): HasMany
    {
        return $this->hasMany(MedicineReservation::class);
    }
}
