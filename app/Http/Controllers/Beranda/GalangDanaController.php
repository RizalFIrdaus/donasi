<?php

namespace App\Http\Controllers\Beranda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalangDanaController extends Controller
{
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
}
