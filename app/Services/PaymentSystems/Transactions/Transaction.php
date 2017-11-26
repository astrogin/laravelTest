<?php

namespace App\Services\PaymentSystems\Transaction;

use App\Order;
use App\Services\PaymentSystems\PaymentSystemInterface;

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
                $transaction->status = 'completed';
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