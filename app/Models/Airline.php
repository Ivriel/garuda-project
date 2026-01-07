<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airline extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'logo',
    ];

    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class);
    }
}
