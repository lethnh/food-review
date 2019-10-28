<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class City_District_Controller extends Controller
{
    public function getCities()
    {
        $cities = City::all();
        return response()->json($cities, 200);
    }

    public function getDistricts()
    {
        $districts = District::all();
        return response()->json($districts, 200);
    }
}
