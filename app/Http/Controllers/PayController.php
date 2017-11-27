<?php

namespace App\Http\Controllers;

use App\Order;
use App\Plan;
use App\Services\PaymentSystems\PaymentSystemInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayController extends Controller
{
    public function pay(Request $request, PaymentSystemInterface $paymentSystem)
    {
        $method = $request->get('payment_method_nonce');
        $plan = Plan::find($request->get('type'));
        $result = $paymentSystem->pay($method, $plan);
        if ($result['success']) {
            $user = Auth::user();
            Order::create([
                'plan_id' => $plan->id,
                'user_id' => $user->id,
                'status' => 'processing',
                'price' => $plan->price,
                'transaction_id' => $result['data']['transaction']->transaction->id
            ]);
        }
        return redirect()->route('home');
    }
}
