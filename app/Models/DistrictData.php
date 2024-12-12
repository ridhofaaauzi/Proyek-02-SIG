<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DistrictData extends Model
{
    use HasFactory;
    protected $table = 'district_data';
    protected $fillable = ['district_id', 'area', 'population', 'year'];

    function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
