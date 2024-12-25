<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator\Contracts;

use Cryptothree\CryptoAddressValidator\Drivers\AbstractDriver;

use function class_exists;

/**
 * @template T
 */
readonly class DriverConfig
{
    /**
     * Create a new driver configuration.
     *
     * @param  class-string<T>  $driver
     * @param  array<string, string>  $mainnet
     * @param  array<string, string>  $testnet
     */
    public function __construct(
        private string $driver,
        private array $mainnet = [],
        private array $testnet = []
    ) {}

    /**
     * Create a new driver instance.
     *
     * @param  bool  $isMainnet
     * @return \Cryptothree\CryptoAddressValidator\Drivers\AbstractDriver|null
     */
    public function makeDriver(bool $isMainnet): ?AbstractDriver
    {
        if (! class_exists($this->driver)) return null;

        return new $this->driver($this->getDriverOptions($isMainnet));
    }

    /**
     * Get the driver options.
     *
     * @param  bool  $isMainnet
     * @return array<string, string>
     */
    private function getDriverOptions(bool $isMainnet): array
    {
        return $isMainnet
            ? $this->mainnet
            : (($this->testnet ?: $this->mainnet) ?: []);
    }

    /**
     * Reconstruct the object state from an array representation.
     *
     * @param  array  $state
     * @return \Cryptothree\CryptoAddressValidator\Contracts\DriverConfig
     */
    public static function __set_state(array $state): DriverConfig
    {
        return new self(
            $state['driver'],
            $state['mainnet'],
            $state['testnet']
        );
    }
}
