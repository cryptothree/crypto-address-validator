<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator;

use Illuminate\Support\ServiceProvider;

class AddressValidationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/address_validator.php',
            'address_validator',
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/address_validator.php' => config_path('address_validator.php'),
            ], 'address-validator-config');
        }
    }
}
