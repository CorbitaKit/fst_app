<?php

namespace App\Services;

use App\Models\User;

class PermissionUserService
{
    public function doStore(int $permissionId, int $userId): void
    {
        $user = User::find($userId);
        $user->permissions()->attach($permissionId);
    }

    public function doDestroy(int $permissionId, int $userId): void
    {
        $user = User::find($userId);
        $user->permissions()->detach($permissionId);
    }
}
