<?php

namespace App\Service;

use App\Models\Profile;
use Illuminate\Http\Request;

interface PaymentService
{
    public function createSnapToken(Profile $profile, Request $request);
    public function apiCreateSnapToken(Profile $profile, Request $request);
}
