<?php

namespace App\Service\Imp;

use App\Http\Requests\PasswordFormRequest;
use App\Models\User;
use App\Models\Profile;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Service\ProfileService;
use Illuminate\Support\Facades\Auth;
use Google\Cloud\Storage\StorageClient;
use App\Http\Requests\ProfileFormRequest;
use Illuminate\Support\Facades\Hash;

class ProfileServiceImp implements ProfileService
{
    public function storeProfile(ProfileFormRequest $request)
    {

        $profile = Profile::where("user_id", Auth::user()->id)->first();
        if (!$profile) {
            $profile = new Profile();
        }
        if ($request->file("photo")) {
            $storage = new StorageClient([
                "project_id" => "donasi-a8c3d",
                "keyFilePath" => base_path("config/credential-firebase.json")
            ]);
            $bucket = $storage->bucket("donasi-a8c3d.appspot.com");
            $fileContent = file_get_contents($request->file('photo')->getPathname());
            $objectName = Auth::user()->id . "." . $request->file('photo')->getClientOriginalName();
            if ($profile->photo) {
                $bucket->object($profile->file_photo)->delete();
            }
            $object = $bucket->upload($fileContent, [
                'name' => $objectName
            ]);
            $profile->photo = $object->signedUrl(Carbon::now()->addYears(50));
            $profile->file_photo = $objectName;
        }
        $profile->user_id = Auth::user()->id;
        $profile->fullname = $request->input("fullname");
        $profile->gender = $request->input("gender");
        $profile->birthday = $request->input("birthday");
        $profile->number_phone = $request->input("number_phone");
        $profile->address = $request->input("address");
        $profile->description = $request->input("description");
        if (!Profile::where("user_id", Auth::user()->id)->first()) {
            $profile->save();
        } else {
            $profile->update();
        }

        $socialmedia = SocialMedia::where("user_id", Auth::user()->id)->first();
        if (!$socialmedia) {
            $socialmedia = new SocialMedia();
        }
        $socialmedia->user_id = Auth::user()->id;
        $socialmedia->instagram = $request->input("instagram");
        $socialmedia->facebook = $request->input("facebook");
        $socialmedia->twitter = $request->input("twitter");
        $socialmedia->tiktok = $request->input("tiktok");
        $socialmedia->save();
    }

    public function updatePassword(PasswordFormRequest $request)
    {
        $user = User::where("email", Auth::user()->email)->first();
        if (!$user)
            return redirect()->back()->withErrors(["error" => "Email tidak terdaftar"]);
        if (Hash::check($request->input("old_password"), $user->password)) {
            if ($request->input("new_password") == $request->input("renew_password")) {
                $user->password = Hash::make($request->input("new_password"));
                return redirect()->route("change-personal-account")->with("message", "Password berhasil diubah");
            }
            return redirect()->back()->withErrors(["error" => "Password baru kamu tidak cocok dengan pengulangan password baru mu"]);
        }
        return redirect()->back()->withErrors(["error" => "Password kamu salah"]);
    }
}
