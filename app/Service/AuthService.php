<?php

namespace App\Service;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;

interface AuthService
{
    public function login(LoginFormRequest $request): bool;
    public function register(RegisterFormRequest $request);
    public function logout();
}
