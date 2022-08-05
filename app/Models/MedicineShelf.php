<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicineShelf extends Model
{
    use HasFactory;
    protected $fillable =['medicine_id' , 'shelf_id' ];


}
