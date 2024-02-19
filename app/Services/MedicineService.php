<?php

namespace App\Services;

use App\Models\Medicine;
use Auth;
use App\Models\MedicineJournal;
use Illuminate\Database\Eloquent\Collection;

class MedicineService
{
    public function doStore(array $medicine): void
    {
        $medicine['user_id'] = Auth::user()->id;
        $medicine = Medicine::create($medicine);
    }

    public function doDestroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $citizen_id = $medicine->citizen_id;

        $medicine->delete();
    }

    public function doUpdate(array $data, $id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->update($data);
    }

    public function doGetCitizenMedicines($citizen_id): Collection
    {
        return Medicine::withoutTrashed()->where('citizen_id', $citizen_id)->get();
    }

    public function doGetMedicine($id): Medicine
    {
        return Medicine::where('id', $id)->first();
    }
}
