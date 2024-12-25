<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator;

use Cryptothree\CryptoAddressValidator\Contracts\Driver;
use Cryptothree\CryptoAddressValidator\Enums\CurrencyEnum;
use Cryptothree\CryptoAddressValidator\Exception\InvalidAddressException;
use Generator;

use function app;
use function config;

readonly class Validator implements Contracts\Validator
{
    public function __construct(
        private string $chain,
        private array $options,
        private bool $isMainnet = true
    ) {}

    public static function make(CurrencyEnum $currency): Validator
    {
        return new Validator($currency->value, config("address_validator.{$currency->value}"), app()->isProduction());
    }

    public function isValid(?string $address): bool
    {
        if (! $address) {
            return false;
        }

        $drivers = $this->getDrivers();
        // if there is no drivers we force address to be valid
        if ($drivers === null || ! $drivers->valid()) {
            return true;
        }

        return (bool) $this->getDriver($drivers, $address)?->check($address);
    }

    public function validate(?string $address): void
    {
        if (! $address) {
            return;
        }

        $drivers = $this->getDrivers();
        // if there is no drivers we force address to be valid
        if ($drivers === null || ! $drivers->valid()) {
            return;
        }

        $driver = $this->getDriver($drivers, $address);

        if ($driver === null) {
            throw new InvalidAddressException(CurrencyEnum::from($this->chain), $address);
        }

        if (! $driver->check($address)) {
            throw new InvalidAddressException(CurrencyEnum::from($this->chain), $address);
        }
    }

    /**
     * @return Generator<int, Driver>|null
     */
    protected function getDrivers(): ?Generator
    {
        /** @var DriverConfig $driverConfig */
        foreach ($this->options as $driverConfig) {
            if ($driver = $driverConfig->makeDriver($this->isMainnet)) {
                yield $driver;
            }
        }

        return null;
    }

    protected function getDriver(iterable $drivers, string $address): ?Driver
    {
        /** @var Driver $driver */
        foreach ($drivers as $driver) {
            if ($driver->match($address)) {
                return $driver;
            }
        }

        return null;
    }
}
