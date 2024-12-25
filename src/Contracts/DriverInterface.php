<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator\Contracts;

interface DriverInterface
{
    /**
     * Check if the given address is match the pattern.
     *
     * @param  string  $address
     * @return bool
     */
    public function match(string $address): bool;

    /**
     * Check if the given address is valid.
     *
     * @param  string  $address
     * @return bool
     */
    public function check(string $address): bool;
}
