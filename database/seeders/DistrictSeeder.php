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
            ['name' => 'Beji', 'alt_name' => 'Kecamatan Beji', 'latitude' => -6.3758816, 'longitude' => 106.8237374],
            ['name' => 'Bojongsari', 'alt_name' => 'Kecamatan Bojongsari', 'latitude' => -6.3991308, 'longitude' => 106.7411559],
            ['name' => 'Cilodong', 'alt_name' => 'Kecamatan Cilodong', 'latitude' => -6.4369807, 'longitude' => 106.8355372],
            ['name' => 'Cimanggis', 'alt_name' => 'Kecamatan Cimanggis', 'latitude' => -6.3644564, 'longitude' => 106.8591387],
            ['name' => 'Cinere', 'alt_name' => 'Kecamatan Cinere', 'latitude' => -6.3360895, 'longitude' => 106.7883416],
            ['name' => 'Cipayung', 'alt_name' => 'Kecamatan Cipayung', 'latitude' => -6.4279175, 'longitude' => 106.8001396],
            ['name' => 'Limo', 'alt_name' => 'Kecamatan Limo', 'latitude' => -6.3701361, 'longitude' => 106.7729399],
            ['name' => 'Pancoran Mas', 'alt_name' => 'Kecamatan Pancoran Mas', 'latitude' => -6.3971623, 'longitude' => 106.8001396],
            ['name' => 'Sawangan', 'alt_name' => 'Kecamatan Sawangan', 'latitude' => -6.4085961, 'longitude' => 106.7647475],
            ['name' => 'Sukmajaya', 'alt_name' => 'Kecamatan Sukmajaya', 'latitude' => -6.3853366, 'longitude' => 106.8473377],
            ['name' => 'Tapos', 'alt_name' => 'Kecamatan Tapos', 'latitude' => -6.409962, 'longitude' => 106.8768415],
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
