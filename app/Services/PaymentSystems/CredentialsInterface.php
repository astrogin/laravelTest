<?php

namespace App\Services\PaymentSystems;

interface CredentialsInterface
{
    public function getEnvironment();
    public function getMerchantId();
    public function getPublicKey();
    public function getPrivateKey();
}
