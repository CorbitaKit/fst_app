<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
        $roleService = new RoleService();
        $roles = $roleService->__invoke();
        return Inertia::render(
            'employees/create',
            [
                'roles' => $roles
            ]
        );
    }

    public function getEmployees()
    {
        $employees = $this->employeeService->doGet();
        return response(json_encode($employees), 200);
    }
}
