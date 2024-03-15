<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    private $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        return Inertia::render(
            'employees/index',
            [
                'employees' => $this->employeeService->doGet()
            ]
        );
    }

    public function store(Request $request)
    {
        $this->employeeService->doStore($request->all());
    }

    public function create()
    {
        return Inertia::render('employees/create');
    }
}
