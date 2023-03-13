<?php

namespace App\Service\Api\imp;

use App\Models\Campaign;
use Illuminate\Support\Str;
use App\Service\Api\Request;
use Illuminate\Support\Carbon;
use Google\Cloud\Storage\StorageClient;
use App\Service\Api\MedicalGalangService;
use App\Http\Requests\Api\MedicalGalangDanaRequestForm;

class MedicalGalangServiceImp implements MedicalGalangService
{
    public function storePhoto(MedicalGalangDanaRequestForm $request, $obj, $name)
    {
        if ($request->file($name)) {
            $storage = new StorageClient([
                "project_id" => "donasi-a8c3d",
                "keyFilePath" => base_path("config/credential-firebase.json")
            ]);
            $bucket = $storage->bucket("donasi-a8c3d.appspot.com");
            $fileContent = file_get_contents($request->file($name)->getPathname());
            $objectName = uniqid() . "." . $request->file($name)->getClientOriginalName();
            if ($obj->donation_photo) {
                $bucket->object('campaign/medical/' . $obj->donation_photo_file)->delete();
            }
            $object = $bucket->upload($fileContent, [
                'name' => 'campaign/medical/' . $objectName
            ]);
            $obj->donation_photo = $object->signedUrl(Carbon::now()->addYears(50));
            $obj->donation_photo_file = $objectName;
        }
    }

    public function saveCampaign(MedicalGalangDanaRequestForm $request): Campaign
    {
        $campaign = new Campaign();
        $campaign->donation_user = $request->input("pasien");
        $campaign->user_id = $request->user()->id;
        $campaign->review = 0;
        $campaign->visible = 0;
        $campaign->user_phone =  $request->input("user_phone");
        $campaign->patient_name =  $request->input("patient_name");
        $campaign->patient_diagnose = $request->input("patient_diagnose");
        $campaign->inpatient =  $request->input("inpatient");
        $campaign->hospital = $request->input("hospital");
        $campaign->effort =  $request->input("effort");
        $campaign->resource =  $request->input("resource");
        $campaign->donation_duration =  $request->input("donation_duration");
        $campaign->donation_amount =  $request->input("donation_amount");
        $campaign->donation_detail = $request->input("donation_detail");
        $campaign->donation_title =  $request->input("donation_title");
        $campaign->donation_slug =  Str::slug($request->input("donation_title"));
        $campaign->donation_story =  $request->input("donation_story");
        $campaign->donation_support = $request->input("donation_support");
        $this->storePhoto($request, $campaign, "donation_photo");
        $campaign->save();
        return $campaign;
    }

    public function updateCampaign(MedicalGalangDanaRequestForm $request, $id): Campaign
    {
        $campaign = Campaign::where("id", $id)->first();
        $campaign->donation_user = $request->input("pasien");
        $campaign->user_id = $request->input("user_id");
        $campaign->visible = 0;
        $campaign->user_phone =  $request->input("user_phone");
        $campaign->patient_name =  $request->input("patient_name");
        $campaign->patient_diagnose = $request->input("patient_diagnose");
        $campaign->inpatient =  $request->input("inpatient");
        $campaign->hospital = $request->input("hospital");
        $campaign->effort =  $request->input("effort");
        $campaign->resource =  $request->input("resource");
        $campaign->donation_duration =  $request->input("donation_duration");
        $campaign->donation_amount =  $request->input("donation_amount");
        $campaign->donation_detail = $request->input("donation_detail");
        $campaign->donation_title =  $request->input("donation_title");
        $campaign->donation_slug =  Str::slug($request->input("donation_title"));
        $campaign->donation_story =  $request->input("donation_story");
        $campaign->donation_support = $request->input("donation_support");
        $this->storePhoto($request, $campaign, "donation_photo");
        $campaign->update();
        return $campaign;
    }
}
