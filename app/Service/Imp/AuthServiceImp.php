<?php

namespace App\Service\Imp;

use Exception;
use App\Models\User;
use App\Service\AuthService;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthServiceImp implements AuthService
{
    public function login(LoginFormRequest $request, array $credential, bool $remember): bool
    {

        if (Auth::attempt($credential, $remember)) {
            $request->session()->regenerate();
            return true;
        }
        return false;
    }
    public function register(RegisterFormRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->input("name");
            $user->email = $request->input("email");
            $user->password = Hash::make($request->input("password"));
            $user->save();
            return $user;
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
    public function logout()
    {
    }
}
