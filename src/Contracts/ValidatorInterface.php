<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator\Contracts;

interface ValidatorInterface
{
    /**
     * Check if the given address is valid.
     *
     * @param  string|null  $address
     * @return bool
     */
    public function isValid(?string $address): bool;

    /**
     * Validate the given address.
     *
     * @param  string|null  $address
     * @return void
     *
     * @throws \Cryptothree\CryptoAddressValidator\Exception\InvalidAddressException
     */
    public function validate(?string $address): void;
}
