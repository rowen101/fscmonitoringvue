<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwtauth')->except('login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['success' => false], 401);
        }

        return response()->json(['success' => true, 'token' => $token, 'user' => $user], 200);
    }
    public function checkToken()
    {
        return response()->json(['success' => true], 200);
    }

    public function logout()
    {
        $logout = auth()->logout();
        return response()->json(['success' => true], 200);
    }
}
