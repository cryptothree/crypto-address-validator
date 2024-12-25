<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator\Drivers;

use Cryptothree\CryptoAddressValidator\Utils\Base58Decoder;
use ParagonIE_Sodium_Compat;
use RangeException;

use function hex2bin;
use function strlen;

class SolBase58Driver extends DefaultBase58Driver
{
    public function match(string $address): bool
    {
        $hexString = Base58Decoder::decode($address, static::$base58Alphabet);

        return strlen($hexString) === 64;
    }

    public function check(string $address): bool
    {
        try {
            $binaryString = hex2bin(Base58Decoder::decode($address, static::$base58Alphabet));

            /**
             * Sodium extension method sometimes returns "conversion failed" exception.
             * $_ = sodium_crypto_sign_ed25519_pk_to_curve25519($binaryString);
             */
            $_ = ParagonIE_Sodium_Compat::crypto_sign_ed25519_pk_to_curve25519($binaryString);

            return true;
        } catch (RangeException|\SodiumException $exception) {
            return false;
        }
    }
}
