<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator\Drivers;

use Cryptothree\CryptoAddressValidator\Contracts\DriverInterface;

abstract class AbstractDriver implements DriverInterface
{
    public function __construct(protected readonly array $options) {}
}
