<?php

namespace App\Services;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FeatureService
{
    public function doGet(): Collection
    {
        return Feature::get();
    }

    public function doStore(array $feature): void
    {
        $feature['user_id'] = Auth::user()->id;
        Feature::create($feature);
    }
}
