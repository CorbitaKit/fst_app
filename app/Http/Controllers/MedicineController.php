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

    public function show($id)
    {
        $medicine = $this->medicineService->doGetMedicine($id);
        return response(json_encode($medicine), 200);
    }

    public function update(Request $request, $id)
    {
        $this->medicineService->doUpdate($request->all(), $id);
    }

    public function getCitizenMedicines($citizen_id)
    {
        $medicines = $this->medicineService->doGetCitizenMedicines($citizen_id);
        return response(json_encode($medicines), 200);
    }
}
