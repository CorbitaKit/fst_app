<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitizenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|unique:citizens|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'social_security_number' => 'required|unique:citizens',
            'birth_day' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'city_id' => 'required',
            'region_id' => 'required',
            'municipality_id' => 'required',
            'note' => 'required',
        ];
    }
}
