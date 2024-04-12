<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function doGetUsers(int $companyId): Collection
    {
        return User::with('role')->whereHas('employee', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->get();
    }

    public function doStore(array $userData): User
    {

        $userData['role_id'] = $userData['role_id']['id'];
        $permissionIds = array_column($userData['permissions'], 'id');
        $user =  User::create($userData);
        $user->permissions()->attach($permissionIds);
        return $user;
    }

    public function doUpdatePassword(string $password)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'password' => Hash::make($password),
            'is_password_changed' => 1
        ]);

        Auth::setUser($user);
    }
    public function doGetUser(int $userId): User
    {
        return User::with('employee')->where('id', $userId)->first();
    }

    public function doUpdate(array $user): void
    {
        $userData = User::findOrFail(Auth::user()->id);
        $userData->update($user);
    }
}
