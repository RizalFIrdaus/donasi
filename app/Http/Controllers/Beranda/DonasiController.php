<?php

namespace App\Http\Controllers\Beranda;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index()
    {
        return view("Beranda.index");
    }

    public function galangdana()
    {
        return view("Beranda.galang-dana");
    }
    public function donasi()
    {
        // $campaigns = Campaign::where("visible", 0)->get();
        $campaigns = Campaign::all();
        return view("Beranda.donasi", compact("campaigns"));
    }

    public function detail($slug)
    {
        $campaign = Campaign::where("donation_slug", $slug)->first();
        // $duration = Carbon::now()->addDays($campaign->donation_duration)->format("Y-m-d");
        // $now = Carbon::now();
        // dd($now->diffInDays($duration));
        if (!$campaign) {
            return redirect()->back();
        }
        return view("Pages.Donation.donasi_detail", compact("campaign"));
    }
}
