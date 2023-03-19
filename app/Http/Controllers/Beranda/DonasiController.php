<?php

namespace App\Http\Controllers\Beranda;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Service\PhotoService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function __construct(private PhotoService $photoService)
    {
    }
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
        $duration_left = $this->photoService->allDurationLeft($campaigns);
        return view("Beranda.donasi", compact("campaigns", "duration_left"));
    }

    public function detail($slug)
    {
        $campaign = Campaign::where("donation_slug", $slug)->first();
        $duration_left = $this->photoService->getDurationLeft($campaign);
        if (!$campaign) {
            return redirect()->back();
        }
        return view("Pages.Donation.donasi_detail", compact("campaign", "duration_left"));
    }
}
