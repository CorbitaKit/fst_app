<?php

namespace App\Services;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class EmployeeService
{
    public function doGet(): Collection
    {
        return Employee::with('user.role', 'user.permissions', 'user')->where('company_id', Auth::user()->employee->company_id)
            ->where('user_id', '!=', Auth::user()->id)->get();
    }

    public function doStore(array $employee): void
    {
        DB::beginTransaction();
        try {
            $userService = new UserService();
            $password = Str::password();
            Session::put('password', $password);
            $user = $userService->doStore([
                'role_id' => $employee['role'],
                'name' => $employee['first_name'] . ' ' . $employee['last_name'],
                'password' => $password,
                'email' => $employee['email'],
                'permissions' => $employee['permissions']
            ]);

            $employee['user_id'] = $user->id;
            $employee['company_id'] = isset($employee['company_id']) ? $employee['company_id'] : Auth::user()->employee->company_id;
            $employee['birth_day'] = Carbon::parse($employee['birth_day'])->format('Y-m-d');
            Employee::create($employee);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function doUpdate(array $employee, int $employeeId): void
    {
        DB::beginTransaction();

        try {
            $userService = new UserService();
            $userService->doUpdate([
                'name' => $employee['first_name'] . ' ' . $employee['last_name'],
                'email' => $employee['email']
            ]);
            $employee['birth_day'] = Carbon::parse($employee['birth_day'])->format('Y-m-d');
            $employeeData = Employee::findOrFail($employeeId);
            $employeeData->update($employee);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }
}
