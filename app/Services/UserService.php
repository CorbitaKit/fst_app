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
        return User::with('role')->where('company_id', $companyId)->get();
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
}
