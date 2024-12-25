<?php

namespace Cryptothree\CryptoAddressValidator\Utils;

use Olifanton\TypedArrays\Uint8Array;

class Checksum
{
    private const POLY_16 = 0x1021;

    /**
     * Calculates CRC16 checksum of given Uint8Array.
     */
    final public static function crc16(Uint8Array $bytes): Uint8Array
    {
        $reg = 0;
        $message = new Uint8Array($bytes->length + 2);

        for ($i = 0; $i < $bytes->length; $i++) {
            $message->fSet($i, $bytes->fGet($i));
        }

        for ($i = 0; $i < $message->length; $i++) {
            $byte = $message->fGet($i);
            $mask = 0x80;

            while ($mask > 0) {
                $reg <<= 1;

                if ($byte & $mask) {
                    $reg += 1;
                }

                $mask >>= 1;

                if ($reg > 0xFFFF) {
                    $reg &= 0xFFFF;
                    $reg ^= self::POLY_16;
                }
            }
        }

        return new Uint8Array([(int) floor($reg / 256), $reg % 256]);
    }
}
