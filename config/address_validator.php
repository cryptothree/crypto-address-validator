<?php

declare(strict_types=1);

use Cryptothree\CryptoAddressValidator\DriverConfig;
use Cryptothree\CryptoAddressValidator\Drivers;
use Cryptothree\CryptoAddressValidator\Enums\CurrencyEnum;

return [
    CurrencyEnum::ADA->value => [
        new DriverConfig(
            Drivers\CardanoDriver::class,
            ['addr' => null],
            ['addr_test' => null],
        ),
        new DriverConfig(
            Drivers\CborDriver::class,
            ['A' => 33, 'D' => 66],
            ['2' => 40, '3' => 73],
        ),
    ],
    CurrencyEnum::BCH->value => [
        new DriverConfig(
            Drivers\Base32Driver::class,
            ['bitcoincash:' => null],
            ['bchtest:' => null, 'bchreg:' => null]
        ),
        new DriverConfig(
            Drivers\DefaultBase58Driver::class,
            ['1' => '00', '3' => '05'],
            ['2' => 'C4', 'm' => '6F']
        ),
    ],
    CurrencyEnum::BSC->value => [
        new DriverConfig(
            Drivers\Bech32Driver::class,
            ['bnb' => null],
            ['tbnb' => null]
        ),
    ],
    CurrencyEnum::BTC->value => [
        new DriverConfig(
            Drivers\DefaultBase58Driver::class,
            ['1' => '00', '3' => '05'],
            ['2' => 'C4', 'm' => '6F']
        ),
        new DriverConfig(
            Drivers\Bech32Driver::class,
            ['bc' => null],
            ['tb' => null, 'bcrt' => null]
        ),
    ],
    CurrencyEnum::DASH->value => [
        new DriverConfig(
            Drivers\DefaultBase58Driver::class,
            ['X' => '4C', '7' => '10'],
            ['y' => '8C', '8' => '13']
        ),
    ],
    CurrencyEnum::DOGE->value => [
        new DriverConfig(
            Drivers\DefaultBase58Driver::class,
            ['D' => '1E', '9' => '16', 'A' => '16'],
            ['n' => '71', 'm' => '6F', '2' => 'C4'],
        ),
    ],
    CurrencyEnum::EOS->value => [
        new DriverConfig(Drivers\EosDriver::class),
    ],
    CurrencyEnum::ETH->value => [
        new DriverConfig(Drivers\KeccakStrictDriver::class),
    ],
    CurrencyEnum::LTC->value => [
        new DriverConfig(
            Drivers\DefaultBase58Driver::class,
            ['L' => '30', 'M' => '32', '3' => '05'],
            ['m' => '6F', 'n' => '6F', '2' => 'C4', 'Q' => '3A']
        ),
        new DriverConfig(
            Drivers\Bech32Driver::class,
            ['ltc' => null],
            ['tltc' => null, 'rltc' => null]
        ),
    ],
    CurrencyEnum::TRX->value => [
        new DriverConfig(
            Drivers\DefaultBase58Driver::class,
            ['T' => '41'],
        ),
    ],
    CurrencyEnum::XRP->value => [
        new DriverConfig(
            Drivers\XrpBase58Driver::class,
            ['r' => '00']
        ),
        new DriverConfig(
            Drivers\XrpXAddressDriver::class,
            ['X' => null],
            ['T' => null],
        ),
    ],
    CurrencyEnum::ZEC->value => [
        new DriverConfig(
            Drivers\DefaultBase58Driver::class,
            ['t' => '1C'],
        ),
    ],
];
