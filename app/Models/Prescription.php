<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'imagePath'];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
