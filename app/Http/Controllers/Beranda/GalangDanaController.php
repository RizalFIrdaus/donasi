<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Campaign;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Service\PhotoService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GalangDanaController extends Controller
{

    public function __construct(private PhotoService $photoService)
    {
    }
    public function step1()
    {
        return view("Campaign.Medical.step1");
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            "pasien" => "required"
        ]);
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
            "user_phone" => "required|numeric",
            "patient_name" => "required|string",
            "patient_diagnose" => "required",
        ]);
        $request->session()->put('step2', [
            "user_phone" => $request->input("user_phone"),
            "patient_phone" => $request->input("patient_phone"),
            "patient_name" => $request->input("patient_name"),
            "patient_diagnose" => $request->input("patient_diagnose"),
        ]);
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
        return redirect()->route('step5.medical.judul');
    }

    public function step5(Request $request)
    {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');
        $step3 = $request->session()->get('step3');
        $step4 = $request->session()->get('step4');

        return view("Campaign.Medical.step5", compact("step1", "step2", "step3", "step4"));
    }

    public function storeStep5(Request $request)
    {
        $request->validate([
            "donation_title" => "required",
            "donation_story" => "required",
            "donation_support" => "required",
            // "donation_photo" => "required"
        ]);
        $request->session()->put('step5', [
            "donation_title" => $request->input("donation_title"),
            "donation_story" => $request->input("donation_story"),
            "donation_support" => $request->input("donation_support"),
            "donation_photo" => $request->input("donation_photo")
        ]);

        $campaign = Campaign::where("user_id", Auth::user()->id)->first();
        if (!$campaign) {
            $campaign = new Campaign();
            $campaign->user_id = Auth::user()->id;
        }
        $this->photoService->storePhoto($request, $campaign, "donation_photo");
        if (!Campaign::where("user_id", Auth::user()->id)->first()) {
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
        $campaign = Campaign::where("user_id", Auth::user()->id)->first();


        return view("Campaign.Medical.review", compact("step1", "step2", "step3", "step4", "step5", "campaign"));
    }


    public function finalReview(Request $request)
    {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');
        $step3 = $request->session()->get('step3');
        $step4 = $request->session()->get('step4');
        $step5 = $request->session()->get('step5');

        $campaign = Campaign::where("user_id", Auth::user()->id)->first();
        $campaign->visible = 0;
        $campaign->donation_user = $step1["pasien"];
        $campaign->user_phone = $step2["user_phone"];
        $campaign->patient_phone = $step2["patient_phone"];
        $campaign->patient_name = $step2["patient_name"];
        $campaign->patient_diagnose = $step2["patient_diagnose"];
        $campaign->inpatient = $step3["inpatient"];
        $campaign->hospital = $step3["hospital"];
        $campaign->effort = $step3["effort"];
        $campaign->resource = $step3["resource"];
        $campaign->donation_duration = $step4["donation_duration"];
        $campaign->donation_amount = $step4["donation_amount"];
        $campaign->donation_detail = $step4["donation_detail"];
        $campaign->donation_title = $step5["donation_title"];
        $campaign->donation_slug = Str::slug($step5["donation_title"]);
        $campaign->donation_story = $step5["donation_story"];
        $campaign->donation_support = $step5["donation_support"];
        $campaign->update();
        $request->session()->forget(["step1", "step2", "step3", "step4", "Step5"]);
        return redirect("/");
    }
}
