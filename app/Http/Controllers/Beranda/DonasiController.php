<?php

namespace App\Http\Controllers\Beranda;

use Carbon\Carbon;
use App\Models\Wallet;
use App\Models\Profile;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Service\PhotoService;
use App\Http\Controllers\Controller;
use App\Models\DonationUser;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

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
        $progress = $this->photoService->allProgress($campaigns);
        return view("Beranda.donasi", compact("campaigns", "duration_left", "progress"));
    }

    public function detail($slug)
    {
        $campaign = Campaign::where("donation_slug", $slug)->first();
        $profile = [];
        if (Auth::user()) {
            $profile = Profile::where("user_id", Auth::user()->id)->first();
        };
        $duration_left = $this->photoService->getDurationLeft($campaign);
        if (!$campaign) {
            return redirect()->back();
        }
        $progress = ($campaign->transaction->current_amount / $campaign->donation_amount) * 100;
        $donation_user = DonationUser::where("campaign_id", $campaign->id)->take(6)->orderBy('created_at', 'DESC')->get();
        $timeline = $this->photoService->timeline_donation($donation_user);
        return view("Pages.Donation.donasi_detail", compact("campaign", "duration_left", "profile", "progress", "donation_user", "timeline"));
    }

    public function sendDonation(Request $request, $slug)
    {
        $request->validate([
            "donation_amount" => "required",
            "message" => "required"
        ]);
        $donation_user = $request->input("donation_amount");
        $campaign = Campaign::where("donation_slug", $slug)->first();
        if (!$campaign) {
            return redirect()->back();
        }
        $profile = Profile::where("user_id", Auth::user()->id)->first();
        $dompet = $profile->wallet->wallet;
        if ($dompet < $donation_user) {
            return redirect()->back()->withErrors(["error" => "Dompetmu gak cukup :( , yuk topup dulu untuk donasi"]);
        }
        $profile->wallet->update([
            "wallet" => $dompet - $donation_user
        ]);
        $transaction = Transaction::where("campaign_id", $campaign->id)->first();
        $transaction->update([
            "current_amount" => $transaction->current_amount + $donation_user
        ]);
        $donation_user = DonationUser::create([
            "user_id" => Auth::user()->id,
            "campaign_id" => $campaign->id,
            "donation_amount" => $donation_user,
            "message" => $request->message
        ]);
        return redirect()->back()->with("message", "Anda sudah berhasil berdonasi, terima kasih #orangBaik");
    }
}
