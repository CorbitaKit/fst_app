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
        $new_citizen_address->city = $citizen->city;
        $new_citizen_address->state = $citizen->state;
        $new_citizen_address->country = $citizen->country;
        $new_citizen_address->citizen_id = $citizen_id;

        $new_citizen_address->save();
    }
}
