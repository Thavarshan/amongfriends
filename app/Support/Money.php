<?php

namespace App\Support;

use Money\Currency;
use NumberFormatter;
use Money\Money as PHPMoney;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

class Money
{
    /**
     * Format the given amount into a displayable currency.
     *
     * @param int         $amount
     * @param string|null $currency
     * @param string|null $locale
     *
     * @return string
     */
    public static function format(int $amount, ?string $currency = null, ?string $locale = null): string
    {
        $money = new PHPMoney($amount, new Currency(
            strtoupper($currency ?? static::preferredCurrency())
        ));

        $locale = $locale ?? static::preferredCurrencyLocale();

        $numberFormatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, new ISOCurrencies());

        return $moneyFormatter->format($money);
    }

    /**
     * Get the supported currency used by the customer.
     *
     * @return string
     */
    public static function preferredCurrency(): string
    {
        return config('billing.currency', 'usd');
    }

    /**
     * Get the supported currency locale used by the customer.
     *
     * @return string
     */
    public static function preferredCurrencyLocale(): string
    {
        return config('billing.currency_locale', 'en');
    }
}
