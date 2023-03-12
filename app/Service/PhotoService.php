<?php

namespace App\Service;

use App\Models\Campaign;
use Illuminate\Http\Request;

interface PhotoService
{
    public function storePhoto(Request $request, $obj, $name);
    public function updateCampaign(Campaign $campaign, $request);
    public function getSession(Request $request): array;
    public function storeTemp(Request $request);
    public function deleteTempCampaign();
}
