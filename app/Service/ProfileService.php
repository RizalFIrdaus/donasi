<?php

namespace App\Service;

use App\Http\Requests\PasswordFormRequest;
use App\Http\Requests\ProfileFormRequest;
use Illuminate\Http\Request;

interface ProfileService
{
    public function storeProfile(ProfileFormRequest $request);
    public function updatePassword(PasswordFormRequest $request);
}
