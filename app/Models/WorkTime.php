<?php

namespace App\Models;

use Database\Factories\WorkTimesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WorkTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'from',
        'to'
    ];

    protected function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    protected static function newFactory()
    {
        return new WorkTimesFactory();
    }
}
