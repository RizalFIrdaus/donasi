<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Campaign;
use Illuminate\Support\Str;
use App\Models\tempCampaign;
use Illuminate\Http\Request;
use App\Service\PhotoService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GalangDanaController extends Controller
{

    public function __construct(private PhotoService $photoService)
    {
    }
    public function step1(Request $request)
    {

        return view("Campaign.Medical.step1");
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            "pasien" => "required"
        ]);

        if ($request->session()->has("progress") == false) {
            $request->session()->put('progress', ["data" => 0]);
        }

        $progress = ceil((1 / 17) * 100);
        if ($progress >= $request->session()->get("progress")["data"]) {
            $request->session()->put('progress', ["data" => $progress]);
        }

        $request->session()->put('step1', [
            "pasien" => $request->input("pasien")
        ]);
        return redirect()->route('step2.medical.tujuan');
    }

    public function step2(Request $request)
    {
        $step1 = $request->session()->get('step1');
        return view("Campaign.Medical.step2", compact("step1"));
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            "user_phone" => "required",
            "patient_name" => "required|string",
            "patient_diagnose" => "required",
        ]);
        $regex = "#^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$#";

        if (Session::has("step1") && Session::get("step1")["pasien"] == "4") {
            if (!preg_match($regex,  $request->input("patient_phone"))) {
                return redirect()->back()->withErrors(['patient_phone' => 'Nomor telepon tidak valid']);
            }
        }

        if (!preg_match($regex,  $request->input("user_phone"))) {
            return redirect()->back()->withErrors(['user_phone' => 'Nomor telepon tidak valid']);
        }

        $request->session()->put('step2', [
            "user_phone" => $request->input("user_phone"),
            "patient_phone" => $request->input("patient_phone"),
            "patient_name" => $request->input("patient_name"),
            "patient_diagnose" => $request->input("patient_diagnose"),
        ]);
        $progress = ceil((4 / 17) * 100);

        if ($progress >= $request->session()->get("progress")["data"]) {
            $request->session()->put('progress', ["data" => $progress]);
        }
        return redirect()->route('step3.medical.riwayatmedis');
    }

    public function step3(Request $request)
    {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');

        return view("Campaign.Medical.step3", compact("step1", "step2"));
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            "inpatient" => "required",
            "hospital" => "required",
            "effort" => "required",
            "resource" => "required",
        ]);

        $request->session()->put('step3', [
            "inpatient" => $request->input("inpatient"),
            "hospital" => $request->input("hospital"),
            "effort" => $request->input("effort"),
            "resource" => $request->input("resource"),
        ]);
        $progress = ceil((9 / 17) * 100);
        if ($progress >= $request->session()->get("progress")["data"]) {
            $request->session()->put('progress', ["data" => $progress]);
        }
        return redirect()->route('step4.medical.targetdonasi');
    }

    public function step4(Request $request)
    {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');
        $step3 = $request->session()->get('step3');

        return view("Campaign.Medical.step4", compact("step1", "step2", "step3"));
    }

    public function storeStep4(Request $request)
    {
        $request->validate([
            "donation_duration" => "required",
            "donation_amount" => "required",
            "donation_detail" => "required",
        ]);

        $request->session()->put('step4', [
            "donation_duration" => $request->input("donation_duration"),
            "donation_amount" => $request->input("donation_amount"),
            "donation_detail" => $request->input("donation_detail"),
        ]);
        $progress = ceil((12 / 17) * 100);
        if ($progress >= $request->session()->get("progress")["data"]) {
            $request->session()->put('progress', ["data" => $progress]);
        }
        return redirect()->route('step5.medical.judul');
    }

    public function step5(Request $request)
    {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');
        $step3 = $request->session()->get('step3');
        $step4 = $request->session()->get('step4');
        $temp = tempCampaign::where("user_id", Auth::user()->id)->first();
        return view("Campaign.Medical.step5", compact("step1", "step2", "step3", "step4", "temp"));
    }

    public function storeStep5(Request $request)
    {
        $request->validate([
            "donation_title" => "required",
            "donation_story" => "required",
            "donation_support" => "required",
        ]);


        $campaign = tempCampaign::where("user_id", Auth::user()->id)->first();
        if (!$campaign) {
            $campaign = new tempCampaign();
            $campaign->user_id = Auth::user()->id;
        }
        $this->photoService->storePhoto($request, $campaign, "donation_photo");
        if (!tempCampaign::where("user_id", Auth::user()->id)->first()) {
            $campaign->save();
        } else {
            $campaign->update();
        }
        $campaign->save();
        return redirect()->route('review.medical');
    }

    public function review(Request $request)
    {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');
        $step3 = $request->session()->get('step3');
        $step4 = $request->session()->get('step4');
        $step5 = $request->session()->get('step5');
        $campaign = tempCampaign::where("user_id", Auth::user()->id)->first();


        return view("Campaign.Medical.review", compact("step1", "step2", "step3", "step4", "step5", "campaign"));
    }


    public function finalReview(Request $request)
    {
        $campaign = new Campaign();
        $this->photoService->updateCampaign($campaign, $request);
        $request->session()->forget(["step1", "step2", "step3", "step4", "step5", "progress"]);
        return redirect("/");
    }
}
