<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthRate extends Model
{
    use HasFactory;
    protected $table = 'birth_rates';
    protected $fillable = ['total', 'birthyear_id'];

    public function birthYear()
    {
        return $this->belongsTo(BirthYear::class, 'birthyear_id');
    }
}