<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cityId = City::where('name', 'Depok')->first()->id;
        $geojsonFilePath = 'geojson/';

        $districts = [
            ['name' => 'Beji', 'alt_name' => 'Kecamatan Beji', 'latitude' => -6.3758816, 'longitude' => 106.8237374, 'polygon' => json_decode(Storage::disk('public')->get('geojson/beji.geojson'), true)],
            ['name' => 'Bojongsari', 'alt_name' => 'Kecamatan Bojongsari', 'latitude' => -6.3991308, 'longitude' => 106.7411559, 'polygon' => json_decode(Storage::disk('public')->get('geojson/bojongsari.geojson'), true)],
            ['name' => 'Cilodong', 'alt_name' => 'Kecamatan Cilodong', 'latitude' => -6.4369807, 'longitude' => 106.8355372, 'polygon' => json_decode(Storage::disk('public')->get('geojson/cilodong.geojson'), true)],
            ['name' => 'Cimanggis', 'alt_name' => 'Kecamatan Cimanggis', 'latitude' => -6.3644564, 'longitude' => 106.8591387, 'polygon' => json_decode(Storage::disk('public')->get('geojson/cimanggis.geojson'), true)],
            ['name' => 'Cinere', 'alt_name' => 'Kecamatan Cinere', 'latitude' => -6.3360895, 'longitude' => 106.7883416, 'polygon' => json_decode(Storage::disk('public')->get('geojson/cinere.geojson'), true)],
            ['name' => 'Cipayung', 'alt_name' => 'Kecamatan Cipayung', 'latitude' => -6.4279175, 'longitude' => 106.8001396, 'polygon' => json_decode(Storage::disk('public')->get('geojson/cipayung.geojson'), true)],
            ['name' => 'Limo', 'alt_name' => 'Kecamatan Limo', 'latitude' => -6.3701361, 'longitude' => 106.7729399, 'polygon' => json_decode(Storage::disk('public')->get('geojson/limo.geojson'), true)],
            ['name' => 'Pancoran Mas', 'alt_name' => 'Kecamatan Pancoran Mas', 'latitude' => -6.3971623, 'longitude' => 106.8001396, 'polygon' => json_decode(Storage::disk('public')->get('geojson/pancoran_mas.geojson'), true)],
            ['name' => 'Sawangan', 'alt_name' => 'Kecamatan Sawangan', 'latitude' => -6.4085961, 'longitude' => 106.7647475, 'polygon' => json_decode(Storage::disk('public')->get('geojson/sawangan.geojson'), true)],
            ['name' => 'Sukmajaya', 'alt_name' => 'Kecamatan Sukmajaya', 'latitude' => -6.3853366, 'longitude' => 106.8473377, 'polygon' => json_decode(Storage::disk('public')->get('geojson/sukmajaya.geojson'), true)],
            ['name' => 'Tapos', 'alt_name' => 'Kecamatan Tapos', 'latitude' => -6.409962, 'longitude' => 106.8768415, 'polygon' => json_decode(Storage::disk('public')->get('geojson/tapos.geojson'), true)],
        ];

        foreach ($districts as $district) {
            $lowerCaseName = strtolower(str_replace(' ', '_', $district['name']));
            $geojsonPath = database_path("seeders/files/{$lowerCaseName}.geojson");

            if (!file_exists($geojsonPath)) {
                throw new \Exception("GeoJSON file not found: {$geojsonPath}");
            }

            $storedPath = Storage::disk('public')->putFileAs("geojson", new \Illuminate\Http\File($geojsonPath), "{$lowerCaseName}.geojson");

            District::create([
                'name' => $district['name'],
                'alt_name' => $district['alt_name'],
                'latitude' => $district['latitude'],
                'longitude' => $district['longitude'],
                'polygon' => $storedPath,
                'city_id' => $cityId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}
