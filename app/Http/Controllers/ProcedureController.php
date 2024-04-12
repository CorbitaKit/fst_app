<?php

namespace App\Http\Controllers;

use App\Services\ProcedureService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProcedureController extends Controller
{

    protected $procedureService;

    public function __construct(ProcedureService $procedureService)
    {
        $this->procedureService = $procedureService;
    }
    public function index()
    {
        $procedures = $this->procedureService->doGet();
        $employees = $this->procedureService->doGetEmployeeCompletionRate();
        return Inertia::render('procedures/index', [
            'procedures' => $procedures,
            'employees' => $employees
        ]);
    }

    public function create()
    {
        return Inertia::render('procedures/create');
    }

    public function store(Request $request)
    {
        $this->procedureService->doStore($request->all());
    }

    public function getCompanyProcedure($employeeId)
    {
        $procedures = $this->procedureService->doGetCompanyProcedures($employeeId);
        $rate = $this->procedureService->getEmployeeComplationRate($employeeId);
        return Inertia::render(
            'procedures/company-procedure',
            [
                'procedures' => $procedures,
                'rate' => $rate
            ]
        );
    }
}
