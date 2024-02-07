<?php

namespace App\Services;

use App\Models\CitizenAddress;

class CitizenAddressService
{
    public function doStore(object $citizen, int $citizen_id): void
    {
        $new_citizen_address = new CitizenAddress;
        $new_citizen_address->address = $citizen->address;
        $new_citizen_address->postcode = $citizen->postcode;
        $new_citizen_address->city_id = $citizen->city_id;
        $new_citizen_address->region_id = $citizen->region_id;
        $new_citizen_address->country = $citizen->country;
        $new_citizen_address->citizen_id = $citizen_id;
        $new_citizen_address->save();
    }
}
