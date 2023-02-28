<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginFormRequest $request)
    {
        $request->validate();
    }

    public function register(RegisterFormRequest $request)
    {
        $request->validate();
    }
}
