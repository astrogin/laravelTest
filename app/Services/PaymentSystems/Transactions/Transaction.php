<?php

namespace App\Services\PaymentSystems\Transactions;

use App\Order;
use App\Services\PaymentSystems\PaymentSystemInterface;
use App\User;

class Transaction
{
    protected $braintree;

    public function __construct(PaymentSystemInterface $paymentSystem)
    {
        $this->braintree = $paymentSystem;
    }

    public function run()
    {
        $transactions = $this->load();
        foreach ($transactions as $transaction) {
            $braintreeTransaction = $this->braintree->find($transaction->transaction_id);
            if ($braintreeTransaction->status === 'settled') {
                $user = User::find($transaction->user_id);
                if ($user) {
                    $user->plan_id = $transaction->plan_id;
                    $user->save();
                }
                $transaction->status = 'completed';
                $transaction->save();
                return;
            }
            if ($braintreeTransaction->status !== 'submitted_for_settlement' && $braintreeTransaction->status !== 'settling') {
                $transaction->status = 'failed';
                $transaction->save();
            }
        }
    }

    protected function load()
    {
        $transactions = Order::where('status', 'processing')->get();
        return $transactions;
    }
}
