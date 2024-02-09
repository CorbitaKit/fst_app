<?php

namespace App\Services\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function doLogin(array $credentials): JsonResponse
    {
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('web-token')->plainTextToken;
            $cookie = cookie('token', $token, 60 * 24);
            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $token,
            ], 200)->withCookie($cookie);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }
    }
}
