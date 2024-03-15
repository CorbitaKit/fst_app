<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
            'users/create'
        );
    }

    public function store(Request $request)
    {
        $this->userService->doStore($request->all());
    }
}
