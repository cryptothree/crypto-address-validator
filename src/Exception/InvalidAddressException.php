<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator\Exception;

use Cryptothree\CryptoAddressValidator\Enums\CurrencyEnum;
use Exception;

class InvalidAddressException extends Exception
{
    /**
     * Constructor.
     *
     * @param  \Cryptothree\CryptoAddressValidator\Enums\CurrencyEnum  $currency
     * @param  string  $address
     */
    public function __construct(CurrencyEnum $currency, string $address)
    {
        $message = "Invalid {$currency->value} address [{$address}].";

        parent::__construct($message);
    }
}
