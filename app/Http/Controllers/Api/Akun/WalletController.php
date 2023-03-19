<?php

namespace App\Http\Controllers\Api\Akun;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Service\PaymentService;
use App\Http\Resources\WalletJson;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    public function __construct(private PaymentService $payment)
    {
    }
    public function show($id)
    {
        $profile = Profile::where("user_id", $id)->first();
        return new WalletJson("Data campaign berhasil ditemukan", $profile->wallet);
    }

    public function store(Request $request)
    {
        $profile = Profile::where("user_id", $request->user()->id)->first();
        $snapToken = $this->payment->apiCreateSnapToken($profile, $request);
        return response()->json([
            "status" => true,
            "data" => $snapToken
        ]);
    }
}
