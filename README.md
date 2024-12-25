# Crypto Address Validator

A PHP library for validating cryptocurrency addresses. Currently, supports 14 chains.

This library is a fork of [Merkeleon/php-cryptocurrency-address-validation](https://github.com/Merkeleon/php-cryptocurrency-address-validation).

## Installation

```
composer require cryptothree/crypto-address-validator
```

## Supported Cryptocurrencies(Chains)

| Symbol | Chain            | Note                                                         |
|--------|------------------|--------------------------------------------------------------|
| ADA    | Cardano          | ...                                                          |
| BCH    | Bitcoin Cash     | ...                                                          |
| BSC    | BNB Beacon Chain | ...                                                          |
| BTC    | Bitcoin          | ...                                                          |
| DASH   | Dashcoin         | ...                                                          |
| DOGE   | Dogecoin         | ...                                                          |
| EOS    | EOS              | ...                                                          |
| ETH    | Ethereum         | Compatible with all EVM chains, support non-checksum address |
| LTC    | Litecoin         | ...                                                          |
| SOL    | Solana           | Only on-curve address can pass the validation                |
| TON    | Ton              | Only support user-friendly address                           |
| TRX    | Tron             | ...                                                          |
| XRP    | Ripple           | ...                                                          |
| ZEC    | Zcash            | ...                                                          |

## Usage

```php
use Cryptothree\CryptoAddressValidator\Enums\CurrencyEnum;
use Cryptothree\CryptoAddressValidator\CryptoAddressValidator;

// create a validator instance
$validator = CryptoAddressValidator::make(CurrencyEnum::BTC);
// can also pass a chain symbol string to the constructor
$validator = CryptoAddressValidator::make('BTC');

$result = $validator->isValid('1BvBMSEYstWetqTFn5Au4m4GFg7xJaNVN2');
// or testnet
$result = $validator->testnet()->isValid('tb1q27dglj7x4l34mj7j2x7e6fqsexk6vf8kew6qm0');
```
