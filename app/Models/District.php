<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $fillable = ['name', 'alt_name', 'latitude', 'longitude', 'polygon', 'city_id'];

    function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    function districtDatas(): HasMany
    {
        return $this->hasMany(DistrictData::class, 'district_id');
    }

    function birthRates(): HasMany
    {
        return $this->hasMany(BirthRate::class, 'district_id');
    }
}
