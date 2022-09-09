<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'description_en',
        'description_ar'
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'receiver_id');
    }
}
