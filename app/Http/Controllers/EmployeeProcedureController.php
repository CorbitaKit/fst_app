<?php

namespace App\Http\Controllers;

use App\Services\EmployeeProcedureService;
use Illuminate\Http\Request;

class EmployeeProcedureController extends Controller
{
    protected $employeeProcedureService;

    public function __construct(EmployeeProcedureService $employeeProcedureService)
    {
        $this->employeeProcedureService = $employeeProcedureService;
    }

    public function markAsComplete($procedureId)
    {
        $this->employeeProcedureService->doAdd($procedureId);
    }
}
