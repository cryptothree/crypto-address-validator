<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator\Drivers;

use function hexdec;

class DefaultBase58Driver extends Base58Driver
{
    protected static string $base58Alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';

    public function check(string $address): bool
    {
        $addressVersion = $this->options[$address[0]] ?? null;
        if ($addressVersion === null) {
            return false;
        }

        $calculatedAddressVersion = $this->getVersion($address);
        if ($calculatedAddressVersion === null) {
            return false;
        }

        return hexdec($addressVersion) === hexdec($calculatedAddressVersion);
    }
}
