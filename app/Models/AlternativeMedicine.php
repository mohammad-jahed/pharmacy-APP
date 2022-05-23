<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlternativeMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'medicine_id'
    ];

    public function alternative(): BelongsTo
    {
        return $this->belongsTo(Medicine::class,'medicine_id','alternative_id');
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
