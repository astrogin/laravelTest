<?php

namespace App\Services\PaymentSystems\Braintree;

use App\Services\PaymentSystems\AuthorizationInterface;
use App\Services\PaymentSystems\TokenInterface;

class TokenBraintreeService implements TokenInterface
{
    private $token;

    public function __construct(AuthorizationInterface $authorization)
    {
        $authorization->authorize();
        $this->token = \Braintree_ClientToken::generate();
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
