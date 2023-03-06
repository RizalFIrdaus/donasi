<?php

namespace App\Service\Imp;

use App\Http\Requests\ProfileFormRequest;
use App\Models\Profile;
use App\Service\ProfileService;

class ProfileServiceImp implements ProfileService
{
    public function storeProfile(ProfileFormRequest $request)
    {
        $profile = new Profile();
        $profile->fullname = $request->input("fullname");
    }
}
