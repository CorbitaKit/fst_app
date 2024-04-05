<?php

namespace App\Http\Controllers;

use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    public function __invoke($userId)
    {
        $permissions = $this->permissionService->getPermissions($userId);

        return response(json_encode($permissions), 200);
    }
}
