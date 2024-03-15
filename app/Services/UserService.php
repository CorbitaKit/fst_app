<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{

    public function doGetUsers(int $companyId): Collection
    {
        return User::with('role')->where('company_id', $companyId)->get();
    }

    public function doStore(array $userData): void
    {
        $userData['role_id'] = $userData['role_id']['id'];
        User::create($userData);
    }
}
