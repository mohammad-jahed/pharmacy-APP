<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicineReservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_id',
        'medicine_id'
    ];

    protected function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    protected function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
