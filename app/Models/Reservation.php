<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property void users;
 * @property void user;
 * @property void pharmacy;
 */
class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pharmacy_id', 'period_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function pharmacy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'pharmacy_id');
    }

    public function reservationUser(): HasMany
    {
        return $this->hasMany(ReservationUser::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reservation_users', 'reservation_id', 'user_id')->as('reservation_user');
    }

    public function medicineReservation(): HasMany
    {
        return $this->hasMany(MedicineReservation::class);
    }
}
