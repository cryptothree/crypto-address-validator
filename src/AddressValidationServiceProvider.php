<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator;

use Illuminate\Support\ServiceProvider;

class AddressValidationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/address_validation.php' => config_path('address_validation.php'),
        ]);
    }
}