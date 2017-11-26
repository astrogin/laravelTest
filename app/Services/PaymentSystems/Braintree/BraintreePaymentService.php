<?php

namespace App\Services\PaymentSystems\Braintree;

use App\Plan;
use App\Services\PaymentSystems\PaymentSystemInterface;
use App\Services\PaymentSystems\AuthorizationInterface;
use Illuminate\Support\Facades\Auth;

class BraintreePaymentService implements PaymentSystemInterface
{
    public function __construct(AuthorizationInterface $authorization)
    {
        $authorization->authorize();
    }

    public function pay(string $paymentMethod, Plan $plan)
    {
        $answer = array(
            'success' => false,
            'code' => 400,
            'data' => array()
        );
        $user = Auth::user();
        $result = \Braintree_Transaction::sale([
            'amount' => $plan->price,
            'orderId' => $plan->id,
            'paymentMethodNonce' => $paymentMethod,
            'customer' => array(
                'firstName' => $user->name,
                'email' => $user->email

            ),
            'options' => array(
                'submitForSettlement' => true
            )
        ]);
        if ($result->success) {
            $answer['success'] = true;
            $answer['code'] = 201;
            $answer['data'] = array(
                'message' => $result->transaction->processorResponseText,
                'transaction' => $result
            );
            return $answer;
        }
        $answer['data'] = array(
            'message' => $result->message,
            'transaction' => $result
        );
        return $answer;
    }

    public function find($id)
    {
        $transaction = \Braintree_Transaction::find($id);
        return $transaction;
    }

}
