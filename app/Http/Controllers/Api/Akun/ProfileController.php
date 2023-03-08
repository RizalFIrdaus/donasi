<?php

namespace App\Http\Controllers\Api\Akun;

use App\Models\User;
use Illuminate\Http\Request;
use App\Service\ProfileService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileFormRequest;
use App\Http\Requests\PasswordFormRequest;

class ProfileController extends Controller
{
    public function __construct(private ProfileService $profile)
    {
    }
    public function updateProfile(ProfileFormRequest $request)
    {
        $this->profile->apiStoreProfile($request);
        return response()->json([
            "status" => "success",
            "message" => "Profil berhasil diubah"
        ]);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            "new_email" => "email|required",
        ]);
        $user = User::where("email", $request->input("new_email"))->first();
        if ($request->input("new_email") == $request->user()->email)
            return response()->error("Kamu tidak bisa mengganti email baru dengan email yang sama", 400);
        if (!$user) {
            $email = User::where("email", $request->user()->email)->first();
            $email->email = $request->input("new_email");
            $email->save();
            return response()->json([
                "status" => "success",
                "message" => "Email berhasil diubah",
                "data" => $email
            ]);
        }
        return response()->error("Email baru yang kamu masukkan sudah dipakai", 400);
    }

    public function updatePassword(PasswordFormRequest $request)
    {
        $user = User::where("email", $request->user()->email)->first();
        if (!$user)
            return response()->error("Email tidak terdaftar", 400);
        if (Hash::check($request->input("old_password"), $user->password)) {
            if ($request->input("new_password") == $request->input("renew_password")) {
                $user->password = Hash::make($request->input("new_password"));
                $user->update();
                return response()->json([
                    "status" => "success",
                    "message" => "Password berhasil diubah"
                ], 200);
            }
            return response()->error("Password baru kamu tidak cocok dengan pengulangan password baru mu", 400);
        }
        return response()->error("Password kamu salah", 400);
    }
}
