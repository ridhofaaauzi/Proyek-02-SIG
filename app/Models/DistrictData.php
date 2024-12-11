<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictData extends Model
{
    use HasFactory;
    protected $table = 'district_data';
    protected $fillable = ['district_id', 'broad', 'total', 'year', 'birthrate_id'];

    function district()
    {
        return $this->belongsTo(District::class);
    }
    function birthRate()
    {
        return $this->belongsTo(BirthRate::class, 'birthrate_id');
    }
}