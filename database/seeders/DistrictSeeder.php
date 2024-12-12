<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cityId = City::where('name', 'Depok')->first()->id;

        $districts = [
            ['name' => 'Beji', 'alt_name' => 'Kecamatan Beji', 'latitude' => -6.3943, 'longitude' => 106.8246],
            ['name' => 'Bojongsari', 'alt_name' => 'Kecamatan Bojongsari', 'latitude' => -6.3749, 'longitude' => 106.8359],
            ['name' => 'Cilodong', 'alt_name' => 'Kecamatan Cilodong', 'latitude' => -6.3237, 'longitude' => 106.7985],
            ['name' => 'Cimanggis', 'alt_name' => 'Kecamatan Cimanggis', 'latitude' => -6.3237, 'longitude' => 106.7985],
            ['name' => 'Cinere', 'alt_name' => 'Kecamatan Cinere', 'latitude' => -6.3550, 'longitude' => 106.8010],
            ['name' => 'Cipayung', 'alt_name' => 'Kecamatan Cipayung', 'latitude' => -6.3237, 'longitude' => 106.7985],
            ['name' => 'Limo', 'alt_name' => 'Kecamatan Limo', 'latitude' => -6.3237, 'longitude' => 106.7985],
            ['name' => 'Pancoran Mas', 'alt_name' => 'Kecamatan Pancoran Mas', 'latitude' => -6.3895, 'longitude' => 106.8350],
            ['name' => 'Sawangan', 'alt_name' => 'Kecamatan Sawangan', 'latitude' => -6.4017, 'longitude' => 106.8081],
            ['name' => 'Sukmajaya', 'alt_name' => 'Kecamatan Sukmajaya', 'latitude' => -6.3237, 'longitude' => 106.7985],
            ['name' => 'Tapos', 'alt_name' => 'Kecamatan Tapos', 'latitude' => -6.3965, 'longitude' => 106.8374],
        ];

        foreach ($districts as $district) {
            District::insert([
                'name' => $district['name'],
                'alt_name' => $district['alt_name'],
                'latitude' => $district['latitude'],
                'longitude' => $district['longitude'],
                'city_id' => $cityId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
