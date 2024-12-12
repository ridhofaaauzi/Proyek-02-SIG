<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::insert([
            'name' => 'Depok',
            'alt_name' => 'Kota Depok',
            'latitude' => -6.402905,
            'longitude' => 106.778419,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
