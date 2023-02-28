<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Service\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService)
    {
    }

    public function login(LoginFormRequest $request)
    {
        $request->validated();
    }

    public function register()
    {
        return view("Akun.register");
    }

    public function doRegister(RegisterFormRequest $request)
    {
        $request->validated();
        $this->authService->register($request);
        return redirect()->route("login");
    }
}
