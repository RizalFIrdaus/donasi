<?php

namespace App\Http\Controllers\Akun;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileFormRequest;
use App\Models\Profile;
use App\Service\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct(private ProfileService $profile)
    {
    }
    public function profile()
    {
        $profile = Profile::where("user_id", Auth()->user()->id)->first();
        return view("Akun.profile", compact("profile"));
    }

    public function updateProfile(ProfileFormRequest $request)
    {
        $this->profile->storeProfile($request);
        return redirect()->back();
    }

    public function account()
    {
        return view("Akun.account");
    }
    public function email()
    {
        return view("Akun.email");
    }
    public function password()
    {
        return view("Akun.password");
    }
}
