<?php

namespace App\Http\Controllers\Api\Beranda;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignCollection;

class MedicalGalangDanaController extends Controller
{

    public function index()
    {
        $campaign = Campaign::all();
        return new CampaignCollection(true, "All data campaign", $campaign);
    }

    public function show($id)
    {
        $campaign = Campaign::where("id", $id)->get();
        if ($campaign->count() == 0) {
            return response()->error("Campaign not found!", 400);
        }
        return new CampaignCollection(true, "Data campaign", $campaign);
    }
}
