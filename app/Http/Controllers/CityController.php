<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CityController extends Controller
{
    public function __invoke($region_id)
    {
        $cityService = new CityService;
        $cities = $cityService->doGetCityByRegion($region_id);
        return response(json_encode($cities), 200);
    }
}
