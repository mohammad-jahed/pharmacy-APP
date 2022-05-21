<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id;
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = ['company_name'];

    public function users(): HasMany
    {
        return $this->HasMany(Medicine::class);
    }
}
