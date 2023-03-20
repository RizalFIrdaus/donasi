<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Campaign;
use Illuminate\Support\Str;
use App\Models\tempCampaign;
use Illuminate\Http\Request;
use App\Service\PhotoService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StepFiveRequest;
use App\Http\Requests\StepFourRequest;
use App\Http\Requests\StepOneRequest;
use App\Http\Requests\StepThreeRequest;
use App\Http\Requests\StepTwoRequest;
use App\Models\Transaction;
use App\Service\GalangDanaService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GalangDanaController extends Controller
{

    public function __construct(private PhotoService $photoService, private GalangDanaService $galangDanaService)
    {
    }
    public function step1()
    {

        return view("Campaign.Medical.step1");
    }

    public function storeStep1(StepOneRequest $request)
    {
        $this->galangDanaService->startProgress($request);
        $this->galangDanaService->updateProgress(
            $request,
            $this->galangDanaService->progress(1, 17)
        );
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

    public function storeStep2(StepTwoRequest $request)
    {
        if (Session::has("step1") && Session::get("step1")["pasien"] == "4") {
            $this->galangDanaService->validationPhone($request, "patient_phone");
        }
        if ($this->galangDanaService->validationPhone($request, "user_phone")) {
            return redirect()->back()->withErrors(["user_phone" => 'Nomor telepon tidak valid']);
        }

        $request->session()->put('step2', [
            "user_phone" => $request->input("user_phone"),
            "patient_phone" => $request->input("patient_phone"),
            "patient_name" => $request->input("patient_name"),
            "patient_diagnose" => $request->input("patient_diagnose"),
        ]);

        $this->galangDanaService->updateProgress(
            $request,
            $this->galangDanaService->progress(4, 17)
        );

        return redirect()->route('step3.medical.riwayatmedis');
    }

    public function step3(Request $request)
    {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');

        return view("Campaign.Medical.step3", compact("step1", "step2"));
    }

    public function storeStep3(StepThreeRequest $request)
    {

        $request->session()->put('step3', [
            "inpatient" => $request->input("inpatient"),
            "hospital" => $request->input("hospital"),
            "effort" => $request->input("effort"),
            "resource" => $request->input("resource"),
        ]);
        $this->galangDanaService->updateProgress(
            $request,
            $this->galangDanaService->progress(9, 17)
        );
        return redirect()->route('step4.medical.targetdonasi');
    }

    public function step4(Request $request)
    {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');
        $step3 = $request->session()->get('step3');

        return view("Campaign.Medical.step4", compact("step1", "step2", "step3"));
    }

    public function storeStep4(StepFourRequest $request)
    {
        $request->session()->put('step4', [
            "donation_duration" => $request->input("donation_duration"),
            "donation_amount" => $request->input("donation_amount"),
            "donation_detail" => $request->input("donation_detail"),
        ]);
        $this->galangDanaService->updateProgress(
            $request,
            $this->galangDanaService->progress(12, 17)
        );
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

    public function storeStep5(StepFiveRequest $request)
    {
        $this->photoService->storeTemp($request);
        return redirect()->route('review.medical');
    }

    public function review(Request $request)
    {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');
        $step3 = $request->session()->get('step3');
        $step4 = $request->session()->get('step4');
        $step5 = $request->session()->get('step5');
        $temp = tempCampaign::where("user_id", Auth::user()->id)->first();


        return view("Campaign.Medical.review", compact("step1", "step2", "step3", "step4", "step5", "temp"));
    }


    public function finalReview(Request $request)
    {
        $campaign = new Campaign();
        $response = $this->photoService->updateCampaign($campaign, $request);
        Transaction::create([
            "campaign_id" => $response->id,
            "done" => 0,
            "current_amount" => 0
        ]);
        $request->session()->forget(["step1", "step2", "step3", "step4", "step5", "progress"]);
        return redirect("/");
    }
}
