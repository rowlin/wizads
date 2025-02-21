<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): array
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('login-', ['*'], now()->addWeek())->plainTextToken;

            return [...$user->only('name', 'email', 'id'), ...['token' => ($token)]];
        }

        abort(401, 'Unauthorized');
    }

}
