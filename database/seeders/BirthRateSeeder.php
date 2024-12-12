<?php

namespace Database\Seeders;

use App\Models\BirthRate;
use App\Models\BirthYear;
use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BirthRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['district_name' => 'Beji', 'birthrates' => [2020 => 2426, 2021 => 2169, 2022 => 1944, 2023 => 1789, 2024 => 537]],
            ['district_name' => 'Bojongsari', 'birthrates' => [2020 => 2279, 2021 => 2074, 2022 => 1903, 2023 => 1705, 2024 => 473]],
            ['district_name' => 'Cilodong', 'birthrates' => [2020 => 2889, 2021 => 2731, 2022 => 2403, 2023 => 2091, 2024 => 629]],
            ['district_name' => 'Cimanggis', 'birthrates' => [2020 => 3791, 2021 => 3614, 2022 => 326, 2023 => 2838, 2024 => 959]],
            ['district_name' => 'Cinere', 'birthrates' => [2020 => 1176, 2021 => 1027, 2022 => 1003, 2023 => 789, 2024 => 248]],
            ['district_name' => 'Cipayung', 'birthrates' => [2020 => 2737, 2021 => 261, 2022 => 2316, 2023 => 2129, 2024 => 654]],
            ['district_name' => 'Limo', 'birthrates' => [2020 => 1607, 2021 => 1482, 2022 => 131, 2023 => 1245, 2024 => 353]],
            ['district_name' => 'Pancoran Mas', 'birthrates' => [2020 => 3688, 2021 => 3373, 2022 => 3012, 2023 => 2704, 2024 => 764]],
            ['district_name' => 'Sawangan', 'birthrates' => [2020 => 3168, 2021 => 2944, 2022 => 2728, 2023 => 2365, 2024 => 704]],
            ['district_name' => 'Sukmajaya', 'birthrates' => [2020 => 3742, 2021 => 3279, 2022 => 2925, 2023 => 2598, 2024 => 764]],
            ['district_name' => 'Tapos', 'birthrates' => [2020 => 4174, 2021 => 3869, 2022 => 3468, 2023 => 3219, 2024 => 929]]
        ];

        foreach ($data as $districtData) {
            $districtId = District::where('name', $districtData['district_name'])->first()->id;

            foreach ($districtData['birthrates'] as $year => $birthrate) {
                $birthYearId = BirthYear::where('years', $year)->first()->id;

                BirthRate::create([
                    'total' => $birthrate,
                    'birthyear_id' => $birthYearId,
                    'district_id' => $districtId,
                ]);
            }
        }
    }
}
