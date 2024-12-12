<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BirthRate extends Model
{
    use HasFactory;
    protected $table = 'birth_rates';
    protected $fillable = ['district_id', 'total', 'birthyear_id'];

    public function birthYear(): BelongsTo
    {
        return $this->belongsTo(BirthYear::class, 'birthyear_id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
