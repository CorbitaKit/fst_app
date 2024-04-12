<?php

namespace App\Services;

use App\Models\Procedure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;

class ProcedureService
{
    public function doGet(): Collection
    {
        return Procedure::where('company_id', Auth::user()->employee->company_id)->get();
    }

    public function doStore(array $procedure): void
    {
        $procedure['company_id'] = Auth::user()->employee->company_id;
        Procedure::create($procedure);
    }

    public function doGetCompanyProcedures($employeeId): Collection
    {
        return Procedure::select('procedures.*')
            ->selectRaw('IFNULL(employee_procedures.employee_id, 0) = ? as completed', [$employeeId])
            ->leftJoin('employee_procedures', function ($join) use ($employeeId) {
                $join->on('procedures.id', '=', 'employee_procedures.procedure_id')
                    ->where('employee_procedures.employee_id', '=', $employeeId);
            })
            ->get();
    }

    public function getEmployeeComplationRate($employeeId): int
    {
        $totalCompletedProcedures = DB::table('employee_procedures')
            ->where('employee_id', $employeeId)
            ->count();

        $totalProcedures = Procedure::count();

        return $totalProcedures > 0 ? ($totalCompletedProcedures / $totalProcedures) * 100 : 0;
    }

    public function doGetEmployeeCompletionRate(): Collection
    {
        $company_id = Auth::user()->employee->company_id;
        $employees = Employee::withCount('procedures')->where('company_id', $company_id)->get();
        $totalProcedures = Procedure::count();

        $employeesWithCompletionRate = $employees->map(function ($employee) use ($totalProcedures) {
            $completedProcedures = DB::table('employee_procedures')
                ->where('employee_id', $employee->id)
                ->count();

            $employee->completion_rate = $totalProcedures > 0 ? ($completedProcedures / $totalProcedures) * 100 : 0;
            return $employee;
        });

        return $employeesWithCompletionRate;
    }
}
