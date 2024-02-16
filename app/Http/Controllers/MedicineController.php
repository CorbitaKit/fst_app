<?php

namespace App\Http\Controllers;

use App\Services\MedicineService;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    protected $medicineService;

    public function __construct(MedicineService $medicineService)
    {
        $this->medicineService = $medicineService;
    }

    public function store(Request $request)
    {
        $this->medicineService->doStore($request->all());
    }

    public function destroy($id)
    {
        $this->medicineService->doDestroy($id);
    }

    public function getCitizenMedicines($citizen_id)
    {
        $medicines = $this->medicineService->doGetCitizenMedicines($citizen_id);
        return response(json_encode($medicines), 200);
    }
}
