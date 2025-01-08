<?php

namespace App\Http\Controllers;

use App\Models\BirthRate;
use App\Models\BirthYear;
use App\Models\City;
use App\Models\District;
use App\Models\DistrictData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $city = City::where('name', 'Depok')->first();
        $city_name = $city->name;
        $latitude = $city->latitude;
        $longitude = $city->longitude;
        $district = District::first();
        $years = BirthYear::pluck('year')->unique();
        $selected_year = $request->input('year', $years->first());
        $selected_district = $request->input('district', $district->id);

        $district_data = DistrictData::where('district_id', $selected_district)
            ->where('year', 2024)
            ->first();

        $birth_rate = BirthRate::with('birthyear', 'district')
            ->whereHas('birthyear', function ($query) use ($selected_year) {
                $query->where('year', $selected_year);
            })
            ->where('district_id', $selected_district)
            ->first();

        return view('index', compact('city_name', 'latitude', 'longitude', 'years', 'selected_year', 'district_data', 'birth_rate'));
    }

    public function getGeoJSON(Request $request)
    {
        $selected_year = $request->input('year', BirthYear::pluck('year')->first());

        $district_datas = DistrictData::with('district')
            ->where('year', '2024')
            ->get();

        $features = $district_datas->map(function ($data) use ($selected_year) {
            $birth_rate = BirthRate::where('district_id', $data->district->id)
                ->whereHas('birthyear', function ($query) use ($selected_year) {
                    $query->where('year', $selected_year);
                })
                ->value('total');

            $geometry = Storage::disk('public')->exists($data->district->polygon)
                ? json_decode(Storage::disk('public')->get($data->district->polygon), true)
                : null;

            return [
                'type' => 'Feature',
                'properties' => [
                    'name' => $data->district->name,
                    'alt_name' => $data->district->alt_name,
                    'area' => $data->area,
                    'population' => $data->population,
                    'year' => $data->year,
                    'latitude' => $data->district->latitude,
                    'longitude' => $data->district->longitude,
                    'district_id' => $data->district->id,
                    'birth_rate' => $birth_rate, // Tambahkan birth_rate ke properti
                ],
                'geometry' => $geometry
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
        ]);
    }
}
