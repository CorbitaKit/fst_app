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
        $new_citizen_address->citizen_id = $citizen_id;
        $new_citizen_address->municipality_id = $citizen->municipality_id;
        $new_citizen_address->save();
    }

    public function doUpdate(object $request, int $citizen_id): void
    {
        $citizen_address = CitizenAddress::where('citizen_id', $citizen_id)->first();
        $citizen_address->update([
            'address' => $request->address,
            'postcode' => $request->postcode,
            'city_id' => $request->city_id,
            'region_id' => $request->region_id,
            'municipality_id' => $request->municipality_id
        ]);
    }
}
