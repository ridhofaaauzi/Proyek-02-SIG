<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\DistrictData;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $city = City::where('name', 'Depok')->first();
        $city_name = $city->name;
        $latitude = $city->latitude;
        $longitude = $city->longitude;

        return view('index', compact('city_name', 'latitude', 'longitude'));
    }

    public function getGeoJSON()
    {
        $district_datas = DistrictData::with('district')->get();
        $features = $district_datas->map(function ($data) {
            return [
                'type' => 'Feature',
                'properties' => [
                    'name' => $data->district->name,
                    'alt_name' => $data->district->alt_name,
                    'area' => $data->area,
                    'population' => $data->population,
                    'year' => $data->year,
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$data->district->longitude, $data->district->latitude]
                ],
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
        ]);
    }
}
