<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

/**
 * @property int id;
 * @property string imagePath;
 */

class Prescription extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = ['user_id', 'imagePath'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
