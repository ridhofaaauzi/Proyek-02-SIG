<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class District extends Model
{
    use HasFactory, HasTranslations;
    protected $table = 'districts';
    protected $fillable = ['name', 'alt_name', 'latitude', 'longitude', 'city_id'];
    public $translatable = ['name', 'alt_name'];

    function city()
    {
        return $this->belongsTo(City::class);
    }
}
