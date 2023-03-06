<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService)
    {
    }

    public function login()
    {
        return view("Akun.login");
    }

    public function register()
    {
        return view("Akun.register");
    }

    public function doLogin(LoginFormRequest $request)
    {
        $credential = $request->validated();
        $remember = $request->has("remember");
        if ($this->authService->login($request, $credential, $remember)) {
            return redirect("/");
        }
        return redirect()->back()->with("failed", "Email atau password salah!");
    }

    public function doRegister(RegisterFormRequest $request)
    {
        $request->validated();
        $this->authService->register($request);
        return redirect()->route("login");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }
}
