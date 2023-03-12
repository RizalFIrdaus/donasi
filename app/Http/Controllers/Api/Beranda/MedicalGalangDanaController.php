<?php

namespace App\Http\Controllers\Api\Beranda;

use App\Models\Campaign;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignJson;
use App\Http\Resources\CampaignCollection;
use App\Http\Requests\Api\MedicalGalangDanaRequestForm;
use App\Service\Api\MedicalGalangService;

class MedicalGalangDanaController extends Controller
{
    public function __construct(private MedicalGalangService $medicalGalangService)
    {
    }
    public function index()
    {
        $campaigns = Campaign::all();
        return new CampaignCollection("Semua data campaign berhasil ditemukan", $campaigns);
    }

    public function show($id)
    {
        $campaign = Campaign::where("id", $id)->first();
        if (!$campaign) {
            return response()->error("Campaign not found!", 400);
        }
        return new CampaignJson("Data campaign berhasil ditemukan", $campaign);
    }

    public function store(MedicalGalangDanaRequestForm $request)
    {
        $campaign = $this->medicalGalangService->saveCampaign($request);
        return new CampaignJson("Data campaign berhasil ditambahkan", $campaign);
    }

    public function update(MedicalGalangDanaRequestForm $request, $id)
    {
        $campaign = $this->medicalGalangService->updateCampaign($request, $id);
        return new CampaignJson("Data campaign berhasil diubah", $campaign);
    }

    public function destroy($id)
    {
        $campaign = Campaign::where("id", $id)->first();
        $campaign->delete();
        return new CampaignJson("Data campaign berhasil dihapus", $campaign);
    }
}
