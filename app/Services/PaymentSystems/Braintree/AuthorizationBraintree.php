<?php

namespace App\Services\PaymentSystems\Braintree;

use App\Services\PaymentSystems\AuthorizationInterface;
use App\Services\PaymentSystems\CredentialsInterface;
use Braintree\Configuration;

class AuthorizationBraintree implements AuthorizationInterface
{
    private $credentials;

    public function __construct(CredentialsInterface $credentials)
    {
        $this->credentials = $credentials;
    }

    public function authorize()
    {
        $environment = $this->credentials->getEnvironment();
        $merchantId = $this->credentials->getMerchantId();
        $publicKey = $this->credentials->getPublicKey();
        $privateKey = $this->credentials->getPrivateKey();
        Configuration::environment($environment);
        Configuration::merchantId($merchantId);
        Configuration::publicKey($publicKey);
        Configuration::privateKey($privateKey);
    }
}
