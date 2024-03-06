<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Citizen;
use App\Services\CitizenAddressService;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class CitizenService
{
    private $citizenAddressService;

    public function __construct(CitizenAddressService $citizenAddressService)
    {
        $this->citizenAddressService = $citizenAddressService;
    }

    public function doGet(): Collection
    {
        return Citizen::get();
    }
    public function doStore(object $citizen): void
    {

        DB::beginTransaction();
        try {
            $new_citizen = new Citizen;

            $new_citizen->email = $citizen->email;
            $new_citizen->first_name = $citizen->first_name;
            $new_citizen->last_name = $citizen->last_name;
            $new_citizen->phone = $citizen->phone;
            $new_citizen->social_security_number = $citizen->social_security_number;
            $new_citizen->birth_day =  Carbon::parse($citizen->birth_day)->format('Y-m-d');
            $new_citizen->note = $citizen->note;
            $new_citizen->save();
            $this->citizenAddressService->doStore($citizen, $new_citizen->id);

            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
        }
    }
    public function doGetCitizenInfo(int $citizen_id): Citizen
    {
        return Citizen::with('address', 'journals', 'medicines', 'plans.goals.subGoals')->where('id', $citizen_id)->first();
    }

    public function doUpdate(int $citizen_id, object $request): void
    {
        $citizen = Citizen::findOrFail($citizen_id);
        DB::beginTransaction();
        try {
            $citizen->update([
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'social_security_number' => $request->social_security_number,
                'birth_day' => Carbon::createFromFormat('d, M Y', $citizen->birth_day)->format('Y-m-d'),
                'note' => $request->note
            ]);
            $this->citizenAddressService->doUpdate($request, $citizen_id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function doDelete(int $citizen_id): void
    {
        Citizen::findOrFail($citizen_id)->delete();
    }
}
