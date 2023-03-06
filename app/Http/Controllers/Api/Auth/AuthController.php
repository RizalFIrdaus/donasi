<?php

namespace App\Http\Controllers\Api\Auth;

use App\Service\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\RegisterFormRequest;


class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }
    public function Login(LoginFormRequest $request)
    {
        $credential = $request->validated();
        if (Auth::attempt($credential)) {
            $token = $request->user()->createToken($request->email);
            return response()->json([
                "status" => "success",
                "message" => "Berhasil login",
                "data" => [
                    "user" => Auth::user(),
                    "token" => $token->plainTextToken
                ]
            ]);
        }
        return Response::error("Gagal login", 400);
    }

    public function Register(RegisterFormRequest $request)
    {
        $request->validated();
        $user = $this->authService->register($request);
        return response()->json([
            "status" => "success",
            "message" => "Berhasil register",
            "data" => $user
        ]);
    }

    public function Logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            "status" => "success",
            "message" => "Berhasil logout"
        ]);
    }
}
