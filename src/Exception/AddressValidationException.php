<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator\Exception;

class AddressValidationException extends \RuntimeException
{
    public function __construct(string $chain, string $notValidAddress, bool $matchedPattern)
    {
        $text = "Incorrect {$chain} address [{$notValidAddress}]";
        $text .= $matchedPattern ? ": address have wrong encoding" : ": address does not matched pattern";
        parent::__construct($text);
    }
}