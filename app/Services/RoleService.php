<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    public function __invoke(): Collection
    {
        return Role::all();
    }
}
