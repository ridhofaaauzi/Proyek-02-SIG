<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BirthYear extends Model
{
    use HasFactory;
    protected $table = 'birth_years';
    protected $fillable = ['years'];

    function birthRates(): HasMany
    {
        return $this->hasMany(BirthRate::class, 'birthyear_id');
    }
}
