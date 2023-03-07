<?php

namespace App\Http\Controllers\Akun;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileFormRequest;
use App\Models\Profile;
use App\Models\SocialMedia;
use App\Models\User;
use App\Service\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct(private ProfileService $profile)
    {
    }
    public function profile()
    {
        $profile = Profile::where("user_id", Auth()->user()->id)->first();
        $socialmedia = SocialMedia::where("user_id", Auth()->user()->id)->first();
        return view("Akun.profile", compact("profile", "socialmedia"));
    }

    public function updateProfile(ProfileFormRequest $request)
    {
        $this->profile->storeProfile($request);
        return redirect()->back()->with("message", "Profil berhasil diubah");
    }

    public function account()
    {
        return view("Akun.account");
    }
    public function email()
    {
        return view("Akun.email");
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            "new_email" => "email|required",
        ]);

        $user = User::where("email", $request->input("new_email"))->first();

        if ($request->input("new_email") == Auth::user()->email)
            return redirect()->back()->withErrors(["error" => "Kamu tidak bisa mengganti email baru dengan email yang sama"]);

        if (!$user) {
            $email = User::where("email", Auth::user()->email)->first();
            $email->email = $request->input("new_email");
            $email->save();
            return redirect()->route("change-personal-account")->with("message", "Email berhasil diubah");
        }
        return redirect()->back()->withErrors(["error" => "Email baru yang kamu masukkan sudah dipakai"]);
    }

    public function password()
    {
        return view("Akun.password");
    }
}
