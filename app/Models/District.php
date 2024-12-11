<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $fillable = ['name', 'alt_name', 'latitude', 'longitude', 'city_id'];

    function city()
    {
        return $this->belongsTo(City::class);
    }
}