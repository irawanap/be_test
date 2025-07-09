<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->sendError('Unauthorized.', ['error' => 'Invalid credentials']);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $success = [
            'token' => $user->createToken('MyApp')->plainTextToken,
            'name'  => $user->name,
        ];

        return $this->sendResponse($success, 'User login successfully.');
    }
}
