<?php

namespace App\Http\Controllers;

use App\Services\PermissionUserService;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{
    private $permissionUserService;

    public function __construct(PermissionUserService $permissionUserService)
    {
        $this->permissionUserService = $permissionUserService;
    }
    public function store(Request $request)
    {
        $this->permissionUserService->doStore($request->id, $request->user_id);
    }

    public function destroy($permissionId, $userId)
    {
        $this->permissionUserService->doDestroy($permissionId, $userId);
    }
}
