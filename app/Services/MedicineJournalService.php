<?php

namespace App\Services;

use App\Models\Citizen;
use App\Models\MedicineJournal;
use Illuminate\Database\Eloquent\Collection;

class MedicineJournalService
{
    public function doGet($citizen_id): Collection
    {
        return MedicineJournal::with(['user', 'citizen', 'medicine' => function ($query) {
            $query->withTrashed();
        }])
            ->where('citizen_id', $citizen_id)
            ->get()->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            });;
    }
}
