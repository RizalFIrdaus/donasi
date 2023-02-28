<?php

namespace App\Service\Imp;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Service\AuthService;

class AuthServiceImp implements AuthService
{
    public function login(LoginFormRequest $request)
    {
    }
    public function register(RegisterFormRequest $request)
    {
        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = $request->input("password");
        $user->save();
    }
    public function logout()
    {
    }
}
