<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeProcedureService
{
    public function doAdd(int $procedureId)
    {
        $employee = Employee::find(Auth::user()->employee->id);
        $employee->procedures()->attach($procedureId);
    }
}
