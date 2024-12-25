<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator;

use Cryptothree\CryptoAddressValidator\Contracts\DriverConfig;
use Cryptothree\CryptoAddressValidator\Contracts\DriverInterface;
use Cryptothree\CryptoAddressValidator\Contracts\ValidatorInterface;
use Cryptothree\CryptoAddressValidator\Enums\CurrencyEnum;
use Cryptothree\CryptoAddressValidator\Exception\InvalidAddressException;
use Generator;
use function app;
use function config;

final class CryptoAddressValidator implements ValidatorInterface
{
    /**
     * CryptoAddressValidator constructor.
     *
     * @param  \Cryptothree\CryptoAddressValidator\Enums\CurrencyEnum  $currency
     * @param  array<\Cryptothree\CryptoAddressValidator\Contracts\DriverConfig>  $options
     * @param  bool  $isMainnet
     */
    public function __construct(
        readonly private CurrencyEnum $currency,
        readonly private array $options,
        private bool $isMainnet = true
    ) {}

    /**
     * Create a new instance of the validator.
     *
     * @param  \Cryptothree\CryptoAddressValidator\Enums\CurrencyEnum|string  $currency
     * @return \Cryptothree\CryptoAddressValidator\CryptoAddressValidator
     */
    public static function make(CurrencyEnum|string $currency): CryptoAddressValidator
    {
        $currency = $currency instanceof CurrencyEnum ? $currency : CurrencyEnum::from($currency);

        return new CryptoAddressValidator($currency, config("address_validator.{$currency->value}"));
    }

    /**
     * Set the network to testnet.
     *
     * @param  bool  $isTestnet
     * @return \Cryptothree\CryptoAddressValidator\CryptoAddressValidator
     */
    public function testnet(bool $isTestnet = true): CryptoAddressValidator
    {
        $this->isMainnet = ! $isTestnet;

        return $this;
    }

    /**
     * Check if the given address is valid.
     *
     * @param  string|null  $address
     * @return bool
     */
    public function isValid(?string $address): bool
    {
        if (! $address) return false;

        $drivers = $this->getDrivers();
        // if there is no drivers we force address to be valid
        if ($drivers === null || ! $drivers->valid()) {
            return true;
        }

        return (bool) $this->getDriver($drivers, $address)?->check($address);
    }

    /**
     * Validate the given address.
     *
     * @param  string|null  $address
     * @return void
     *
     * @throws \Cryptothree\CryptoAddressValidator\Exception\InvalidAddressException
     */
    public function validate(?string $address): void
    {
        if(! $this->isValid($address)) {
            throw new InvalidAddressException($this->currency, $address);
        }
    }

    /**
     * Get the drivers.
     *
     * @return Generator<int, DriverInterface>|null
     */
    protected function getDrivers(): ?Generator
    {
        foreach ($this->options as $driverConfig) {
            if ($driver = $driverConfig->makeDriver($this->isMainnet)) {
                yield $driver;
            }
        }

        return null;
    }

    /**
     * Get the driver.
     *
     * @param  iterable  $drivers
     * @param  string  $address
     * @return \Cryptothree\CryptoAddressValidator\Contracts\DriverInterface|null
     */
    protected function getDriver(iterable $drivers, string $address): ?DriverInterface
    {
        foreach ($drivers as $driver) {
            if ($driver->match($address)) {
                return $driver;
            }
        }

        return null;
    }
}
