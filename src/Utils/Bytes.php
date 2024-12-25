<?php

namespace Cryptothree\CryptoAddressValidator\Utils;

use InvalidArgumentException;
use Olifanton\TypedArrays\ArrayBuffer;
use Olifanton\TypedArrays\Uint16Array;
use Olifanton\TypedArrays\Uint32Array;
use Olifanton\TypedArrays\Uint8Array;

use function ord;
use function strlen;

class Bytes
{
    /**
     * Returns a Uint8Array from a PHP byte string.
     *
     * Example:
     * ```php
     * $a = Bytes::stringToBytes('a');
     * $a[0] === 97; // True, because the ASCII code of `a` is 97 in decimal
     * ```
     */
    public static function stringToBytes(string $str, int $size = 1): Uint8Array
    {
        $buf = null;
        $bufView = null;

        if ($size === 1) {
            $buf = new ArrayBuffer(strlen($str));
            $bufView = new Uint8Array($buf);
        }

        if ($size === 2) {
            $buf = new ArrayBuffer(strlen($str) * 2);
            $bufView = new Uint16Array($buf);
        }

        if ($size === 4) {
            $buf = new ArrayBuffer(strlen($str) * 4);
            $bufView = new Uint32Array($buf);
        }

        if ($buf === null) {
            throw new InvalidArgumentException("Unsupported size: $size");
        }

        for ($i = 0, $strLen = strlen($str); $i < $strLen; $i++) {
            $bufView[$i] = ord($str[$i]);
        }

        return new Uint8Array($bufView);
    }

    /**
     * Returns an immutable fragment from the given Uint8Array.
     */
    public static function arraySlice(Uint8Array $bytes, int $start, int $end): Uint8Array
    {
        return new Uint8Array($bytes->buffer->slice($start, $end));
    }
}
