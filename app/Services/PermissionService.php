<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class PermissionService
{
    public function getPermissions(int $userId): Collection
    {
        return Permission::with(['users' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->get();
    }
}
