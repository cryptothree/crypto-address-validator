<?php

namespace Cryptothree\CryptoAddressValidator\Drivers;

use Cryptothree\CryptoAddressValidator\Utils\Base64Decoder;
use Cryptothree\CryptoAddressValidator\Utils\Bytes;
use Cryptothree\CryptoAddressValidator\Utils\Checksum;

class TonDriver extends AbstractDriver
{
    private const BOUNCEABLE_TAG = 0x11;

    private const NON_BOUNCEABLE_TAG = 0x51;

    private const TEST_FLAG = 0x80;

    public function match(string $address): bool
    {
        // user-friendly address should contain strictly 48 characters
        $pattern = '/^[A-Za-z0-9_-]{48}$/';

        return preg_match($pattern, $address) === 1;
    }

    public function check(string $address): bool
    {
        $data = Bytes::stringToBytes(Base64Decoder::decodeUrlSafe($address));
        if ($data->length !== 36) return false;

        $addr = Bytes::arraySlice($data, 0, 34);
        $crc = Bytes::arraySlice($data, 34, 36);
        $checkCrc = Checksum::crc16($addr);
        if (! ($crc[0] === $checkCrc[0] && $crc[1] === $checkCrc[1])) return false;

        $tag = $addr[0];
        $isTestOnly = false;

        if ($tag & self::TEST_FLAG) {
            $isTestOnly = true;
            $tag ^= self::TEST_FLAG;
        }

        // check if the address is for the correct network
        $isMainnet = (bool) $this->options[0];
        if ($isMainnet === $isTestOnly) return false;

        // check if the address is bounceable or non-bounceable
        if ($tag !== self::BOUNCEABLE_TAG && $tag !== self::NON_BOUNCEABLE_TAG) return false;

        // check workchain id
        $workchain = $addr[1] === 0xFF ? -1 : $addr[1];
        if ($workchain !== 0 && $workchain !== -1) return false;

        return true;
    }
}
