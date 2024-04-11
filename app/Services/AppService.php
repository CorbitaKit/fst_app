<?php

namespace App\Services;

use App\Models\App;

class AppService
{
    public function doGet()
    {
        return App::get()->groupBy('type');
    }
}
