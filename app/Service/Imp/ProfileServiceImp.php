<?php

namespace App\Service\Imp;

use App\Models\Profile;
use Illuminate\Support\Carbon;
use App\Service\ProfileService;
use Illuminate\Support\Facades\Auth;
use Google\Cloud\Storage\StorageClient;
use App\Http\Requests\ProfileFormRequest;
use App\Models\SocialMedia;

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
}
