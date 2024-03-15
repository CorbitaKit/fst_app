<?php

namespace App\Services;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class EmployeeService
{
    public function doGet(): Collection
    {
        return Employee::with('user.role')->where('company_id', Auth::user()->company_id)->get();
    }

    public function doStore(array $employee): void
    {
        $userService = new UserService();
        $user = $userService->doStore([
            'role_id' => $employee['role'],
            'name' => $employee['first_name'] . ' ' . $employee['last_name'],
            'password' => $employee['last_name'],
            'email' => $employee['email']
        ]);
        $employee['user_id'] = $user->id;
        $employee['company_id'] = Auth::user()->company_id;
        $employee['birth_day'] = Carbon::parse($employee['birth_day'])->format('Y-m-d');
        Employee::create($employee);
    }
}
