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

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
