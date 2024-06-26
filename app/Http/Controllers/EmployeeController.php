<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
                'employees' => $this->employeeService->doGet(),
                'settings' => Auth::user()->employee->company->settings
            ]
        );
    }

    public function store(EmployeeRequest $request)
    {


        $this->employeeService->doStore($request->all());
    }

    public function create()
    {
        $roleService = new RoleService();
        $roles = $roleService->__invoke();
        return Inertia::render(
            'employees/create',
            [
                'roles' => $roles
            ]
        );
    }

    public function update(Request $request, $employeeId)
    {
        $this->employeeService->doUpdate($request->all(), $employeeId);
    }

    public function getEmployees()
    {
        $employees = $this->employeeService->doGet();
        return response(json_encode($employees), 200);
    }
}
