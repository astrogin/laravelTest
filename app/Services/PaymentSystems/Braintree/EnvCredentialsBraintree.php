<?php

namespace App\Services\PaymentSystems\Braintree;

use App\Services\PaymentSystems\CredentialsInterface;

class EnvCredentialsBraintree implements CredentialsInterface
{
    private $environment;
    private $merchantId;
    private $publicKey;
    private $privateKey;

    public function __construct()
    {
        $this->environment = env('BT_ENVIRONMENT');
        $this->merchantId = env('BT_MERCHANT_ID');
        $this->publicKey = env('BT_PUBLIC_KEY');
        $this->privateKey = env('BT_PRIVATE_KEY');
    }

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }
}
