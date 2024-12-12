<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory, HasTranslations;
    protected $table = 'cities';
    protected $fillable = ['name', 'alt_name', 'latitude', 'longitude'];
    public $translatable = ['name', 'alt_name'];
}
