<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\PermissionService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    private $userService;
    private $permissionService;
    public function __construct(UserService $userService, PermissionService $permissionService)
    {
        $this->userService = $userService;
        $this->permissionService = $permissionService;
    }
    public function getUsersInCompany($companyId)
    {
        return Inertia::render(
            'users/index',
            [
                'users' => $this->userService->doGetUsers($companyId)
            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'users/create',
            [
                'permissions' => $this->permissionService->doGetPermissions()
            ]
        );
    }

    public function store(UserRequest $request)
    {
        $this->userService->doStore($request->all());
    }

    public function updatePassword(Request $request)
    {
        $this->userService->doUpdatePassword($request->password);
    }

    public function show($userId)
    {
        $user = $this->userService->doGetUser($userId);
        return Inertia::render('users/edit-profile', [
            'user' => $user
        ]);
    }
}
