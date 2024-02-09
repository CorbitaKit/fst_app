<?php

namespace App\Services;

use App\Models\Medicine;
use Auth;
use App\Models\MedicineJournal;

class MedicineService
{
    public function doStore(array $medicine): void
    {
        $medicine['user_id'] = Auth::user()->id;
        $medicine = Medicine::create($medicine);

        MedicineJournal::create([
            'user_id' => Auth::user()->id,
            'action' => 'Add',
            'medicine_id' => $medicine->id,
            'citizen_id' => $medicine['citizen_id']
        ]);
    }

    public function doDestroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $citizen_id = $medicine->citizen_id;

        // $medicine->delete();

        MedicineJournal::create([
            'user_id' => Auth::user()->id,
            'action' => 'Delete',
            'medicine_id' => $id,
            'citizen_id' => $citizen_id
        ]);
    }
}
