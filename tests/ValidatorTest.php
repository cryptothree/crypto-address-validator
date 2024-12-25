<?php

declare(strict_types=1);

namespace Tests;

use Cryptothree\CryptoAddressValidator\CryptoAddressValidator;
use Cryptothree\CryptoAddressValidator\Enums\CurrencyEnum;

/**
 * @coversDefaultClass \Cryptothree\CryptoAddressValidator\CryptoAddressValidator
 */
class ValidatorTest extends TestCase
{
    /**
     * @covers ::isValid
     *
     * @dataProvider currencyAddressProvider
     *
     * @param  CurrencyEnum  $currency
     * @param  string  $net
     * @param  bool  $expected
     * @param  string  $address
     * @return void
     */
    public function test_currency_validator(CurrencyEnum $currency, string $net, bool $expected, string $address): void
    {
        $config = require __DIR__.'/../config/address_validator.php';

        $options = $config[$currency->value];

        $validator = new CryptoAddressValidator($currency, $options, $net === 'mainnet');

        $this->assertEquals(
            $expected,
            $validator->isValid($address),
            "[{$currency->value}] address [{$address}] is invalid"
        );
    }

    public function currencyAddressProvider(): array
    {
        return [
            'Beacon #1' => [CurrencyEnum::BSC, 'mainnet', true, 'bnb1fnd0k5l4p3ck2j9x9dp36chk059w977pszdgdz'],
            'Beacon #2' => [CurrencyEnum::BSC, 'mainnet', true, 'bnb1xd8cn4w7q4hm4fc9a68xtpx22kqenju7ea8d3v'],
            'Beacon #3' => [CurrencyEnum::BSC, 'testnet', true, 'tbnb1nuxna8asq69jf05cldcxpx9ee0m7drd9qz3aru'],
            'Beacon #4' => [CurrencyEnum::BSC, 'mainnet', false, 'bnb1nuxna8asq69jf05cldcxpx9ee0m7drd9qz3aru'],
            'Beacon #5' => [CurrencyEnum::BSC, 'testnet', false, 'bnb1nuxna8asq69jf05cldcxpx9ee0m7drd9qz3aru'],
            //
            'BitcoinCash #1' => [CurrencyEnum::BCH, 'mainnet', true, 'bitcoincash:qp009ldhprp75mgn4kgaw8jvrpadnvg8qst37j42kx'],
            'BitcoinCash #2' => [CurrencyEnum::BCH, 'mainnet', true, 'bitcoincash:qz7032ylhvxmndkx438pd8kjd7k7zcqxzsf26q0lvr'],
            'BitcoinCash #3' => [CurrencyEnum::BCH, 'mainnet', true, '32uLhn19ZasD5bsVhLdDthhM37JhJHiEE2'],
            'BitcoinCash #4' => [CurrencyEnum::BCH, 'mainnet', true, 'qz52zsruu43sq7ed0srym3g0ktpyjkdkxcm949pl2z'],
            'BitcoinCash #5' => [CurrencyEnum::BCH, 'mainnet', true, 'qpf8eq7ygvhqjwydk9n29f6nyc8rcjhlwcuwngn6xk'],
            'BitcoinCash #6' => [CurrencyEnum::BCH, 'testnet', true, 'bchtest:qp2vjh349lcd22hu0hv6hv9d0pwlk43f6u04d5jk36'],
            'BitcoinCash #7' => [CurrencyEnum::BCH, 'testnet', true, 'qp2vjh349lcd22hu0hv6hv9d0pwlk43f6u04d5jk36'],
            'BitcoinCash #8' => [CurrencyEnum::BCH, 'testnet', false, '1KADKOasjxpNKzbfcKjnigLYWjEFPcMXqf'],
            'BitcoinCash #9' => [CurrencyEnum::BCH, 'mainnet', true, 'qpnxwdu09eq4gqxv0ala37yj5evmmakf5vpp770edu'],
            'BitcoinCash #10' => [CurrencyEnum::BCH, 'mainnet', true, 'bitcoincash:qpnxwdu09eq4gqxv0ala37yj5evmmakf5vpp770edu'],
            'BitcoinCash #11' => [CurrencyEnum::BCH, 'testnet', false, 'bchtest:qpnxwdu09eq4gqxv0ala37yj5evmmakf5vpp770edu'],
            'BitcoinCash #12' => [CurrencyEnum::BCH, 'testnet', false, 'bchreg:qpnxwdu09eq4gqxv0ala37yj5evmmakf5vpp770edu'],
            'BitcoinCash #13' => [CurrencyEnum::BCH, 'mainnet', true, 'bitcoincash:pwqwzrf7z06m7nn58tkdjyxqfewanlhyrpxysack85xvf3mt0rv02l9dxc5uf'],
            'BitcoinCash #14' => [CurrencyEnum::BCH, 'mainnet', true, 'bitcoincash:qr6m7j9njldwwzlg9v7v53unlr4jkmx6eylep8ekg2'],
            //
            'Bitcoin #1' => [CurrencyEnum::BTC, 'mainnet', true, '1BvBMSEYstWetqTFn5Au4m4GFg7xJaNVN2'],
            'Bitcoin #2' => [CurrencyEnum::BTC, 'mainnet', true, 'bc1q6v096h88xmpl662af0nc7wd3vta56zv6pyccl8'],
            'Bitcoin #3' => [CurrencyEnum::BTC, 'testnet', true, 'tb1q27dglj7x4l34mj7j2x7e6fqsexk6vf8kew6qm0'],
            'Bitcoin #4' => [CurrencyEnum::BTC, 'testnet', false, 'tb1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq'],
            'Bitcoin #5' => [CurrencyEnum::BTC, 'mainnet', false, 'tb1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq'],
            'Bitcoin #6' => [CurrencyEnum::BTC, 'testnet', false, '1BvBMSEYstWetqTFn5Au4m4GFg7xJaNVN2'],
            'Bitcoin #7' => [CurrencyEnum::BTC, 'testnet', false, 'bc1q6v096h88xmpl662af0nc7wd3vta56zv6pyccl8'],
            'Bitcoin #8' => [CurrencyEnum::BTC, 'mainnet', true, 'BC1QL2725QLXHGWQ7F7XLJ8363FJCUF25XZ35SWRU5'],
            'Bitcoin #9' => [CurrencyEnum::BTC, 'mainnet', true, 'bc1p5gyty9x2lrk65yndaeh242zm6xklgrv9nze9477dg0kyv6yvfljq0lqjkh'],
            //
            'Cardano #1' => [CurrencyEnum::ADA, 'mainnet', true, 'addr1v9ywm0h3r8cnxrs04gfy7c3s2j44utjyvn5ldjdca0c2ltccgqdes'],
            'Cardano #2' => [CurrencyEnum::ADA, 'mainnet', false, 'stake1u9f9v0z5zzlldgx58n8tklphu8mf7h4jvp2j2gddluemnssjfnkzz'],
            'Cardano #3' => [CurrencyEnum::ADA, 'mainnet', true, 'addr1qxy3w62dupy9pzmpdfzxz4k240w5vawyagl5m9djqquyymrtm3grn7gpnjh7rwh2dy62hk8639lt6kzn32yxq960usnq9pexvt'],
            'Cardano #4' => [CurrencyEnum::ADA, 'mainnet', true, 'Ae2tdPwUPEYwNguM7TB3dMnZMfZxn1pjGHyGdjaF4mFqZF9L3bj6cdhiH8t'],
            'Cardano #5' => [CurrencyEnum::ADA, 'mainnet', true, 'DdzFFzCqrht2KYLcX8Vu53urCG52NxpgrGQvP9Mcp15Q8BkB9df9GndFDBRjoWTPuNkLW3yeQiFVet1KA7mraEkJ84AK2RwcEh3khs12'],
            'Cardano #6' => [CurrencyEnum::ADA, 'testnet', true, '37btjrVyb4KBbrmcxh3qQzswqDB4SCU8L68vYBJshaeYQ8rHVBfrAfuXZNyFHtR8QXUKR4CtytMyX4DwhsPYKKgFSpq8f5KxNz2s6Guqr6c6LzcHck'],
            'Cardano #7' => [CurrencyEnum::ADA, 'testnet', true, '2cWKMJemoBaipAW1NGegM2qWevSgpL9baiizayY4NnTBvxRGyppr2uym7F9eEtRLehFek'],
            'Cardano #8' => [CurrencyEnum::ADA, 'testnet', true, 'addr_test1qzfst6x8f4r47vm4qfeuj7g8r5pgkjnv5cuzjk94u8p7sd3gtlpjssk2fy95k4z5lr48tu48fcqstnzte44d8f8v8vhs9pwu4x'],
            //
            'Dashcoin #1' => [CurrencyEnum::DASH, 'mainnet', true, 'XpESxaUmonkq8RaLLp46Brx2K39ggQe226'],
            'Dashcoin #2' => [CurrencyEnum::DASH, 'mainnet', true, 'XmZQkfLtk3xLtbBMenTdaZMxsUBYAsRz1o'],
            'Dashcoin #3' => [CurrencyEnum::DASH, 'testnet', true, 'yNpxAuCGxLkDmVRY12m4qEWx1ttgTczSMJ'],
            'Dashcoin #4' => [CurrencyEnum::DASH, 'testnet', true, 'yi7GRZLiUGrJfX2aNDQ3v7pGSCTrnLa87o'],
            //
            'Dogecoin #1' => [CurrencyEnum::DOGE, 'mainnet', true, 'DFrGqzk4ZnTcK1gYtxZ9QDJsDiVM8v8gwV'],
            'Dogecoin #2' => [CurrencyEnum::DOGE, 'mainnet', true, 'DMzanBYjj3yYHtCcnEucn7H8LHNY9fARB8'],
            'Dogecoin #3' => [CurrencyEnum::DOGE, 'testnet', true, 'mketxxXxaBeH7AhCBMatdH5ATVad2XHQdj'],
            'Dogecoin #4' => [CurrencyEnum::DOGE, 'testnet', false, 'n3TZFrdPvwGqfPC7vBb8PGgbFwc1Cnxq9h'],
            'Dogecoin #5' => [CurrencyEnum::DOGE, 'testnet', true, 'nd5N1KW1waCicK1vqfwtTcBSbQCHBLv2Um'],
            'Dogecoin #6' => [CurrencyEnum::DOGE, 'testnet', false, 'DFundMr7W8PjB6ZmVwGv1L1WtZ2X3m3KgQ'],
            'Dogecoin #7' => [CurrencyEnum::DOGE, 'mainnet', false, 'n3TZFrdPvwGqfPC7vBb8PGgbFwc1Cnxq9h'],
            //
            'Ethereum #1' => [CurrencyEnum::ETH, 'mainnet', true, '0xe80b351948D0b87EE6A53e057A91467d54468D91'],
            'Ethereum #2' => [CurrencyEnum::ETH, 'testnet', true, '0x799aD3Ff7Ef43DfD1473F9b8a8C4237c22D8113F'],
            'Ethereum #3' => [CurrencyEnum::ETH, 'mainnet', true, '0xe80b351948d0b87ee6a53e057a91467d54468d91'],
            'Ethereum #4' => [CurrencyEnum::ETH, 'testnet', true, '0x799ad3ff7ef43dfd1473f9b8a8c4237c22d8113f'],
            //
            'Litecoin #1' => [CurrencyEnum::LTC, 'mainnet', true, 'MF5yqnMuNoiCiCXbZft7iFgLK5BPG5QKbE'],
            'Litecoin #2' => [CurrencyEnum::LTC, 'mainnet', false, '1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp'],
            'Litecoin #3' => [CurrencyEnum::LTC, 'mainnet', true, '3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAj'],
            'Litecoin #4' => [CurrencyEnum::LTC, 'mainnet', true, 'LbTjMGN7gELw4KbeyQf6cTCq859hD18guE'],
            'Litecoin #5' => [CurrencyEnum::LTC, 'mainnet', true, 'MK9xC9sbktt6DHMF6XwA3eZPJ2Vx32AXFT'],
            'Litecoin #6' => [CurrencyEnum::LTC, 'testnet', true, 'mpQA36uSXDGxySjknqHFVMdsLPgPnbm7ku'],
            'Litecoin #7' => [CurrencyEnum::LTC, 'mainnet', true, 'ltc1qf6wcq8kc0unt3wuaszlkms3zkuerxlfaz07zmj'],
            //
            'Ripple #1' => [CurrencyEnum::XRP, 'mainnet', true, 'r4dgY6Mzob3NVq8CFYdEiPnXKboRScsXRu'],
            //
            'Tron #1' => [CurrencyEnum::TRX, 'mainnet', true, 'TC9fKEGcBTfmvXKXLHq5MJDC8P7dhZQM92'],
            'Tron #2' => [CurrencyEnum::TRX, 'testnet', true, 'TRALQkt1v9MjUVn3gT7csfpodJDmnC6q8s'],
            //
            'Zcash #1' => [CurrencyEnum::ZEC, 'mainnet', true, 't1YQV51DKzKP63xJcynXuRfryMjfmgTJ7Jc'],
            'Zcash #2' => [CurrencyEnum::ZEC, 'mainnet', true, 't1VJhyyvbi63Cu6nEVVgNHSCokDRa3repZB'],
            'Zcash #3' => [CurrencyEnum::ZEC, 'testnet', true, 't1VJhyyvbi63Cu6nEVVgNHSCokDRa3repZB'],
            //
            'EOS #1' => [CurrencyEnum::EOS, 'mainnet', true, 'atticlabeosb'],
            'EOS #2' => [CurrencyEnum::EOS, 'mainnet', true, 'bitfinexeos1'],
            //
            'SOL #1' => [CurrencyEnum::SOL, 'mainnet', true, 'Ds9iTf1dhM3DAwsFPJzYkg7pyGgvJs8UBibvcWaJ98BM'],
            'SOL #2' => [CurrencyEnum::SOL, 'mainnet', true, 'ob2htHLoCu2P6tX7RrNVtiG1mYTas8NGJEVLaFEUngk'],
            'SOL #3' => [CurrencyEnum::SOL, 'testnet', false, 'A9vVkQnZn38REExiwLUGRo6Jc5s244FyDZruTGbNDeuk'],
            'SOL #4' => [CurrencyEnum::SOL, 'testnet', true, 'JD25qVdtd65FoiXNmR89JjmoJdYk9sjYQeSTZAALFiMy'],
            'SOL #5' => [CurrencyEnum::SOL, 'mainnet', true, 'AbJroZNQ7NJ9NWcgvFy5mLyrp38LZShtkECqDaPq31FZ'],
            'SOL #6' => [CurrencyEnum::SOL, 'mainnet', true, '94wYtGdHsrvizfYHWhYeNw9DPfWsPvcEtgUjsfqJMtya'],
            'SOL #7' => [CurrencyEnum::SOL, 'mainnet', false, '96wYtGdHsrvizfYHWhYeNw9DPfWsPvcEtgUjsfqJMtya'],
            'SOL #8' => [CurrencyEnum::SOL, 'mainnet', false, 'Ds7iTf1dhM3DAwsFPJzYkg7pyGgvJs8UBibvcWaJ98BM'],
            'SOL #9' => [CurrencyEnum::SOL, 'mainnet', false, 'o_2htHLoCu2P6tX7RrNVtiG1mYTas8NGJEVLaFEUngk'],
            //
            'TON #1' => [CurrencyEnum::TON, 'mainnet', true, 'EQDtFpEwcFAEcRe5mLVh2N6C0x-_hJEM7W61_JLnSF74p4q2'],
            'TON #2' => [CurrencyEnum::TON, 'mainnet', true, 'UQDtFpEwcFAEcRe5mLVh2N6C0x-_hJEM7W61_JLnSF74p9dz'],
            'TON #3' => [CurrencyEnum::TON, 'testnet', false, 'EQDtFpEwcFAEcRe5mLVh2N6C0x-_hJEM7W61_JLnSF74p4q2'],
            'TON #4' => [CurrencyEnum::TON, 'testnet', false, 'UQDtFpEwcFAEcRe5mLVh2N6C0x-_hJEM7W61_JLnSF74p9dz'],
            'TON #5' => [CurrencyEnum::TON, 'testnet', true, 'kQDtFpEwcFAEcRe5mLVh2N6C0x-_hJEM7W61_JLnSF74pzE8'],
            'TON #6' => [CurrencyEnum::TON, 'testnet', true, '0QDtFpEwcFAEcRe5mLVh2N6C0x-_hJEM7W61_JLnSF74p2z5'],
            'TON #7' => [CurrencyEnum::TON, 'mainnet', false, 'kQDtFpEwcFAEcRe5mLVh2N6C0x-_hJEM7W61_JLnSF74pzE8'],
            'TON #8' => [CurrencyEnum::TON, 'mainnet', false, '0QDtFpEwcFAEcRe5mLVh2N6C0x-_hJEM7W61_JLnSF74p2z5'],
            'TON #9' => [CurrencyEnum::TON, 'mainnet', true, 'UQAD5n5HO9zCa3lTQOK_zdALUrP692QPpP14AKubUH7bF8Ak'],
            'TON #10' => [CurrencyEnum::TON, 'mainnet', false, 'UBAD5n5HO9zCa3lTQOK_zdALUrP692QPpP14AKubUH7bF8Ak'],
            'TON #11' => [CurrencyEnum::TON, 'mainnet', false, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'],
        ];
    }
}
