<?php

namespace App\Models;

use Database\Factories\WorkTimesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'from',
        'to'
    ];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory(): WorkTimesFactory
    {
        return new WorkTimesFactory();
    }
}
