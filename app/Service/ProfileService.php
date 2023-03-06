<?php

namespace App\Service;

use App\Http\Requests\ProfileFormRequest;

interface ProfileService
{
    public function storeProfile(ProfileFormRequest $request);
}
