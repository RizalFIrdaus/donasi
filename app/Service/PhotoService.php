<?php

namespace App\Service;

use Illuminate\Http\Request;

interface PhotoService
{
    public function storePhoto(Request $request, $obj, $name);
}
