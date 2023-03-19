<?php

namespace App\Service\Imp;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Payment;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Service\PaymentService;
use Illuminate\Support\Facades\Auth;

class PaymentServiceImp implements PaymentService
{
    public function createSnapToken(Profile $profile, Request $request)
    {

        Config::$serverKey = config("midtrans.server_key");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config("midtrans.production");
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;
        $order_id = substr(uniqid(), 0, 13) . substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(37 / strlen($x)))), 1, 37);
        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' =>  $request->amount,
            ),
            'customer_details' => array(
                'first_name' => $profile->fullname,
                'last_name' => '',
                'email' => Auth::user()->email,
                'phone' => $profile->number_phone,
            ),
        );
        $payment = Payment::where("order_id", $order_id)->first();
        if (!isset($payment)) {
            $payment = Payment::create([
                "wallet_id" => $profile->wallet->id,
                "order_id" => $order_id,
                "amount" => $request->amount,
                "status" => "unpaid"
            ]);
        }
        return [
            "snapToken" => Snap::getSnapToken($params),
            "payment" => $payment
        ];
    }

    public function apiCreateSnapToken(Profile $profile, Request $request)
    {
        Config::$serverKey = config("midtrans.server_key");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config("midtrans.production");
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;
        $order_id = substr(uniqid(), 0, 13) . substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(37 / strlen($x)))), 1, 37);
        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' =>  $request->amount,
            ),
            'customer_details' => array(
                'first_name' => $profile->fullname,
                'last_name' => '',
                'email' => $request->user()->email,
                'phone' => $profile->number_phone,
            ),
        );
        $payment = Payment::where("order_id", $order_id)->first();
        if (!isset($payment)) {
            $payment = Payment::create([
                "wallet_id" => $profile->wallet->id,
                "order_id" => $order_id,
                "amount" => $request->amount,
                "status" => "unpaid"
            ]);
        }
        return [
            "snapToken" => Snap::getSnapToken($params),
            "payment" => $payment
        ];
    }
}
