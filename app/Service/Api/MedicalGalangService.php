<?php

namespace App\Service\Api;

use App\Models\Campaign;
use App\Http\Requests\Api\MedicalGalangDanaRequestForm;

interface MedicalGalangService
{
    public function storePhoto(MedicalGalangDanaRequestForm $request, $obj, $name);
    public function saveCampaign(MedicalGalangDanaRequestForm $request): Campaign;
    public function updateCampaign(MedicalGalangDanaRequestForm $request, $id): Campaign;
}
