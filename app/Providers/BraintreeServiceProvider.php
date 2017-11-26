<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BraintreeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Braintree::class);
        $this->app->bind(
            'App\Services\PaymentSystems\CredentialsInterface',
            'App\Services\PaymentSystems\Braintree\EnvCredentialsBraintree'
        );
        $this->app->bind(
            'App\Services\PaymentSystems\TokenInterface',
            'App\Services\PaymentSystems\Braintree\TokenBraintreeService'
        );
        $this->app->bind(
            'App\Services\PaymentSystems\AuthorizationInterface',
            'App\Services\PaymentSystems\Braintree\AuthorizationBraintree'
        );
        $this->app->bind(
            'App\Services\PaymentSystems\PaymentSystemInterface',
            'App\Services\PaymentSystems\Braintree\BraintreePaymentService'
        );
    }
}
