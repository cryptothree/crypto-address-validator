<?php

declare(strict_types=1);

namespace Cryptothree\CryptoAddressValidator\Enums;

enum CurrencyEnum: string
{
    case ADA = 'ADA'; // Cardano
    case BCH = 'BCH'; // Bitcoin Cash
    case BSC = 'BSC'; // BNB Beacon
    case BTC = 'BTC'; // Bitcoin
    case DASH = 'DASH'; // Dashcoin
    case DOGE = 'DOGE'; // Dogecoin
    case EOS = 'EOS'; // EOS
    case ETH = 'ETH'; // Ethereum
    case LTC = 'LTC'; // Litecoin
    case TRX = 'TRX'; // Tron
    case XRP = 'XRP'; // Ripple
    case ZEC = 'ZEC'; // Zcash
}
