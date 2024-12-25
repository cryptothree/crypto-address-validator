<?php

namespace Cryptothree\CryptoAddressValidator\Utils;

class Base64Decoder
{
    public static function decodeUrlSafe(string $data): false|string
    {
        // Replace URL safe characters with standard Base64 characters
        $base64 = str_replace(['-', '_'], ['+', '/'], $data);

        // Add padding if necessary
        $padding = strlen($base64) % 4;
        if ($padding > 0) {
            $base64 .= str_repeat('=', 4 - $padding);
        }

        // Decode the Base64 string
        return base64_decode($base64);
    }
}
