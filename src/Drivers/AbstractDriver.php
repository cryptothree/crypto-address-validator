<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator\Drivers;

use Cryptothree\CryptoAddressValidator\Contracts\Driver;

abstract class AbstractDriver implements Driver
{
    public function __construct(protected readonly array $options)
    {
    }
}