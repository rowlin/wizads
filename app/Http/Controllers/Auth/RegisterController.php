<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
        ]);
        $token = $user->createToken('login-', ['*'], now()->addWeek())->plainTextToken;

        return [...$user->only('name', 'email', 'id'), ...['token' => ($token)]];
    }

}
