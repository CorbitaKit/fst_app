<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitizenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'social_security_number' => $this->social_security_number,
            'birth_day' => $this->birth_day,
            'phone' => $this->phone,
            'address' => $this->address->address,
            'region_id' => $this->address->region_id,
            'municipality_id' => $this->address->municipality_id,
            'city_id' => $this->address->city_id,
            'postcode' => $this->address->postcode,
            'note' => $this->note,
            'name' => $this->first_name . ' ' . $this->last_name
        ];
    }
}
