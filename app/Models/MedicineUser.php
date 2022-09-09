<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int pharmacy_id;
 * @property int medicine_id;
 * @property int quantity;
 * @property Carbon expiration_date;
 * @property mixed $medicine
 * @property mixed $pharmacy
 */
class MedicineUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'pharmacy_id',
        'quantity',
        'expiration_date'
    ];

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function pharmacy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pharmacy_id', 'id');
    }
}
