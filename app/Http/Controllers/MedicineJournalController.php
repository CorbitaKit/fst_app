<?php

namespace App\Http\Controllers;

use App\Services\MedicineJournalService;
use Illuminate\Http\Request;

class MedicineJournalController extends Controller
{
    private $medJournalService;

    public function __construct(MedicineJournalService $medicineJournalService)
    {
        $this->medJournalService = $medicineJournalService;
    }

    public function getCitizenMedicineJournal($citizen_id)
    {
        return $this->medJournalService->doGet($citizen_id);
    }
}
