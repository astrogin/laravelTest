<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Services\PaymentSystems\PaymentSystemInterface;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function pay(Request $request, PaymentSystemInterface $paymentSystem)
    {
        $method = $request->get('payment_method_nonce');
        $plan = Plan::find($request->get('type'));
        $paymentSystem->pay($method, $plan);
        return redirect()->route('home');
    }
}
