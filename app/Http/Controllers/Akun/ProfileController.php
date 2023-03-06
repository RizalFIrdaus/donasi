<?php

namespace App\Http\Controllers\Akun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        return view("Akun.profile");
    }
    public function account()
    {
        return view("Akun.account");
    }
    public function email()
    {
        return view("Akun.email");
    }
}
