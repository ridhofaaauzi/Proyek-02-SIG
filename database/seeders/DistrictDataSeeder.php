<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\DistrictData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['name' => 'Beji', 'area' => 14.56, 'population' => 158195],
            ['name' => 'Bojongsari', 'area' => 19.3, 'population' => 130429],
            ['name' => 'Cilodong', 'area' => 16.19, 'population' => 163934],
            ['name' => 'Cimanggis', 'area' => 21.58, 'population' => 238085],
            ['name' => 'Cinere', 'area' => 10.55, 'population' => 85197],
            ['name' => 'Cipayung', 'area' => 11.45, 'population' => 165922],
            ['name' => 'Limo', 'area' => 11.84, 'population' => 101352],
            ['name' => 'Pancoran Mas', 'area' => 18.03, 'population' => 241903],
            ['name' => 'Sawangan', 'area' => 26.19, 'population' => 175215],
            ['name' => 'Sukmajaya', 'area' => 17.35, 'population' => 249716],
            ['name' => 'Tapos', 'area' => 33.26, 'population' => 257883]
        ];

        foreach ($districts as $district) {
            $districtId = District::where('name', $district['name'])->first()->id;

            DistrictData::insert([
                'district_id' => $districtId,
                'area' => $district['area'],
                'population' => $district['population'],
                'year' => '2024',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
