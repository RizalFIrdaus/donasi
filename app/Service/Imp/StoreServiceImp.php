<?php

namespace App\Service\Imp;

use Carbon\Carbon;
use App\Models\Campaign;
use App\Models\tempCampaign;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Service\PhotoService;
use Illuminate\Support\Facades\Auth;
use Google\Cloud\Storage\StorageClient;

class StoreServiceImp implements PhotoService
{
    public function storePhoto(Request $request, $obj, $name)
    {
        if ($request->file($name)) {
            $storage = new StorageClient([
                "project_id" => "donasi-a8c3d",
                "keyFilePath" => base_path("config/credential-firebase.json")
            ]);
            $bucket = $storage->bucket("donasi-a8c3d.appspot.com");
            $fileContent = file_get_contents($request->file($name)->getPathname());
            $objectName = uniqid() . "." . $request->file($name)->getClientOriginalName();
            if (!$obj->donation_photo_file == "donation_default.jpg") {
                if ($obj->donation_photo) {
                    $bucket->object('campaign/medical/' . $obj->donation_photo_file)->delete();
                }
            }
            $object = $bucket->upload($fileContent, [
                'name' => 'campaign/medical/' . $objectName
            ]);
            $obj->donation_photo = $object->signedUrl(Carbon::now()->addYears(50));
            $obj->donation_photo_file = $objectName;
            $progress = ceil((17 / 17) * 100);
            if ($progress >= $request->session()->get("progress")["data"]) {
                $request->session()->put('progress', ["data" => $progress]);
            }
            $request->session()->put('step5', [
                "donation_title" => $request->input("donation_title"),
                "donation_story" => $request->input("donation_story"),
                "donation_support" => $request->input("donation_support"),
                "donation_photo" => $obj->donation_photo,
                "donation_photo_file" => $objectName
            ]);
        } else {
            if (!$obj->donation_photo) {
                $obj->donation_photo = asset("img/donation_default.jpg");
                $obj->donation_photo_file = "donation_default.jpg";
                $request->session()->put('step5', [
                    "donation_title" => $request->input("donation_title"),
                    "donation_story" => $request->input("donation_story"),
                    "donation_support" => $request->input("donation_support"),
                    "donation_photo" => $obj->donation_photo,
                    "donation_photo_file" => $obj->donation_photo_file
                ]);
            }
        }
    }

    public function updateCampaign(Campaign $campaign, $request)
    {

        $getSession = $this->getSession($request);

        $campaign->user_id = Auth::user()->id;
        $campaign->review = 0;
        $campaign->visible = 0;
        $campaign->donation_user = $getSession["step1"]["pasien"];
        $campaign->user_phone = $getSession["step2"]["user_phone"];
        $campaign->patient_phone = $getSession["step2"]["patient_phone"];
        $campaign->patient_name = $getSession["step2"]["patient_name"];
        $campaign->patient_diagnose = $getSession["step2"]["patient_diagnose"];
        $campaign->inpatient = $getSession["step3"]["inpatient"];
        $campaign->hospital = $getSession["step3"]["hospital"];
        $campaign->effort = $getSession["step3"]["effort"];
        $campaign->resource = $getSession["step3"]["resource"];
        $campaign->donation_duration = $getSession["step4"]["donation_duration"];
        $campaign->donation_amount = $getSession["step4"]["donation_amount"];
        $campaign->donation_detail = $getSession["step4"]["donation_detail"];
        $campaign->donation_title = $getSession["step5"]["donation_title"];
        $campaign->donation_slug = Str::slug($getSession["step5"]["donation_title"]);
        $campaign->donation_story = $getSession["step5"]["donation_story"];
        $campaign->donation_support = $getSession["step5"]["donation_support"];
        $campaign->donation_photo = $getSession["step5"]["donation_photo"];
        $campaign->donation_photo_file = $getSession["step5"]["donation_photo_file"];
        $campaign->save();
        $this->deleteTempCampaign();
    }

    public function getSession(Request $request): array
    {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');
        $step3 = $request->session()->get('step3');
        $step4 = $request->session()->get('step4');
        $step5 = $request->session()->get('step5');
        return [
            "step1" => $step1,
            "step2" => $step2,
            "step3" => $step3,
            "step4" => $step4,
            "step5" => $step5,
        ];
    }

    public function deleteTempCampaign()
    {
        $temp = tempCampaign::where("user_id", Auth::user()->id)->first();
        if (isset($temp))
            $temp->delete();
    }

    public function storeTemp(Request $request)
    {
        $campaign = tempCampaign::where("user_id", Auth::user()->id)->first();
        if (!$campaign) {
            $campaign = new tempCampaign();
            $campaign->user_id = Auth::user()->id;
        }
        $this->storePhoto($request, $campaign, "donation_photo");
        if (!tempCampaign::where("user_id", Auth::user()->id)->first()) {
            $campaign->save();
        } else {
            $campaign->update();
        }
        $campaign->save();
    }

    public function apiStorePhoto(Request $request, $obj, $name)
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
}
