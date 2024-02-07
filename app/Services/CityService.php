<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

class CityService
{
    public function doGetCityByRegion($region_id): Collection
    {
        return City::where('region_id', $region_id)->get();
    }
}
