<?php

namespace App\Services;

use App\Models\Citizen;
use App\Models\MedicineJournal;
use Illuminate\Database\Eloquent\Collection;

class MedicineJournalService
{
    public function doGet($citizen_id): Collection
    {
        return MedicineJournal::with('user', 'citizen', 'medicine')->where('citizen_id', $citizen_id)->get();
    }
}
