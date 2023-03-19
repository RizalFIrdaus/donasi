<?php

namespace App\Http\Controllers\Akun;

use App\Models\User;
use App\Models\Profile;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Service\ProfileService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileFormRequest;
use App\Http\Requests\PasswordFormRequest;
use App\Models\Campaign;
use App\Models\Payment;
use App\Models\Wallet;
use App\Service\PaymentService;

class ProfileController extends Controller
{

    public function __construct(private ProfileService $profile, private PaymentService $payment)
    {
    }
    public function profile()
    {
        $profile = Profile::where("user_id", Auth()->user()->id)->first();
        $socialmedia = SocialMedia::where("user_id", Auth()->user()->id)->first();
        return view("Akun.profile", compact("profile", "socialmedia"));
    }

    public function updateProfile(ProfileFormRequest $request)
    {
        $this->profile->storeProfile($request);
        $profile = Profile::where("user_id", Auth::user()->id)->first();
        if (!Wallet::where("profile_id", $profile->id)->exists()) {
            Wallet::create([
                "profile_id" => $profile->id,
                "wallet" => 0
            ]);
        }
        return redirect()->back()->with("message", "Profil berhasil diubah");
    }

    public function account()
    {
        return view("Akun.account");
    }
    public function email()
    {
        return view("Akun.email");
    }
    public function dompet()
    {
        $profile = Profile::where("user_id", Auth::user()->id)->first();
        $payment = Payment::where("wallet_id", $profile->wallet->id)->where("status", "unpaid")->first();
        if (!$profile) {
            return redirect()->route("change-profile")->withErrors(["error" => "Lengkapi data kamu terlebih dahulu"]);
        }
        if (!$payment) {
            session()->forget("snapToken");
        }
        if (session()->has("snapToken")) {
            return redirect()->route("checkout");
        }
        return view("Akun.dompet", compact("profile"));
    }
    public function bayar()
    {
        $profile = Profile::where("user_id", Auth::user()->id)->first();
        $payment = Payment::where("wallet_id", $profile->wallet->id)->where("status", "unpaid")->first();
        if (!session()->has("snapToken")) {
            return back()->with('error', 'Snap Token not available');
        }
        $snapToken = session()->get("snapToken");
        return view("Akun.checkout", compact("profile", "snapToken"));
    }
    public function checkout(Request $request)
    {
        $profile = Profile::where("user_id", Auth::user()->id)->first();
        $payment = Payment::where("wallet_id", $profile->wallet->id)->where("status", "unpaid")->first();
        if ($payment) {
            $payment->delete();
        }
        $snapToken = $this->payment->createSnapToken($profile, $request);
        session()->put(["snapToken" => $snapToken]);
        return redirect()->route("bayar");
    }


    public function updateEmail(Request $request)
    {
        $request->validate([
            "new_email" => "email|required",
        ]);

        $user = User::where("email", $request->input("new_email"))->first();

        if ($request->input("new_email") == Auth::user()->email)
            return redirect()->back()->withErrors(["error" => "Kamu tidak bisa mengganti email baru dengan email yang sama"]);

        if (!$user) {
            $email = User::where("email", Auth::user()->email)->first();
            $email->email = $request->input("new_email");
            $email->save();
            return redirect()->route("change-personal-account")->with("message", "Email berhasil diubah");
        }
        return redirect()->back()->withErrors(["error" => "Email baru yang kamu masukkan sudah dipakai"]);
    }

    public function password()
    {
        return view("Akun.password");
    }

    public function updatePassword(PasswordFormRequest $request)
    {
        $user = User::where("email", Auth::user()->email)->first();
        if (!$user)
            return redirect()->back()->withErrors(["error" => "Email tidak terdaftar"]);
        if (Hash::check($request->input("old_password"), $user->password)) {
            if ($request->input("new_password") == $request->input("renew_password")) {
                $user->password = Hash::make($request->input("new_password"));
                $user->update();
                return redirect()->route("change-personal-account")->with("message", "Password berhasil diubah");
            }
            return redirect()->back()->withErrors(["error" => "Password baru kamu tidak cocok dengan pengulangan password baru mu"]);
        }
        return redirect()->back()->withErrors(["error" => "Password kamu salah"]);
    }

    public function campaign()
    {
        $campaigns_na = Campaign::where("user_id", Auth::user()->id)->where("review", 0)->where("visible", 0)->get();
        $campaigns_a = Campaign::where("user_id", Auth::user()->id)->where("review", 1)->where("visible", 1)->get();
        $campaigns_r = Campaign::where("user_id", Auth::user()->id)->where("review", 1)->where("visible", 0)->get();
        return view("Akun.campaign", compact("campaigns_na", "campaigns_a", "campaigns_r"));
    }

    public function campaignReview($id)
    {
        $campaign = Campaign::where("user_id", Auth::user()->id)->where("id", $id)->first();
        $exist = Campaign::where("user_id", Auth::user()->id)->where("visible", 1)->exists();
        if ($exist) {
            return redirect()->back()->withErrors("Kamu hanya bisa membuat 1 campaign yang aktif !");
        } else {
            if (!$campaign) {
                return redirect()->back()->withErrors("Campaign tidak ada !");
            }
            $campaign->review = 1;
            $campaign->update();
            return redirect()->back();
        }
    }

    public function campaignActive($id)
    {
        $campaign = Campaign::where("user_id", Auth::user()->id)->where("review", 1)->where("visible", 0)->where("id", $id)->first();
        if (!$campaign) {
            return redirect()->back()->withErrors(["message" => "Campaign not found!"]);
        }
        $campaign->review = 0;
        $campaign->update();
        return redirect()->back();
    }

    public function campaignDelete($id)
    {
        $campaign = Campaign::where("user_id", Auth::user()->id)->where("review", 0)->where("visible", 0)->where("id", $id)->first();
        if (!$campaign) {
            return redirect()->back()->withErrors(["message" => "Campaign not found!"]);
        }
        $campaign->delete();
        return redirect()->back();
    }
}
