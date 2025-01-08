<?php

namespace Database\Seeders;

use App\Models\BirthYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BirthYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = [2020, 2021, 2022, 2023, 2024];

        foreach ($years as $year) {
            BirthYear::insert([
                'year' => $year,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
