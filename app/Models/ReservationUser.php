<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'user_id'
    ];

    protected function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
