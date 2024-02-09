<?php

namespace App\Services;

use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;

class RegionService
{
    public function doGet(): Collection
    {
        return Region::with('municipalities.cities')->get();
    }
}
