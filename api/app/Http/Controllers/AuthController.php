<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Register new user
     * @param RegisterRequest $request
     * @return string[]
     */
    public function register(RegisterRequest $request)
    {

        User::create($request->all());

        return [
            'message' => 'Registered successfully',
        ];

    }


    public function login(LoginRequest $request)
    {
        if(!auth()->attempt($request->only('email', 'password'))){
            throw new AuthenticationException('Invalid email or password');
        }


        $token = auth()->user()->createToken('user-token');

        return [
            'message' => ['successfully logged in'],
            'token' => $token->plainTextToken
        ];
    }

    public function logout()
    {
        \auth()->user()->currentAccessToken()->delete();

        return [
            'message' => 'Successfully logged out',
        ];
    }

    /**
     * Get authenticated user
     */
    public function user()
    {
        return new UserResource(auth()->user());
    }
}
