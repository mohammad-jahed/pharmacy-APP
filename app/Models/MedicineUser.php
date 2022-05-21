<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int pharmacy_id;
 */
class MedicineUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'pharmacy_id'
    ];

    public function getAttribute($key)
    {
        return $key;
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function pharmacy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'pharmacy_id');
    }
}
