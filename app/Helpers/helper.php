<?php

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

if (! function_exists('rupeeFormatter')) {
    function rupeeFormatter($amount)
    {

        $amountInPaisa = $amount * 100;

        $revenue = new Money($amountInPaisa, new Currency('INR'));

        $formatter = new IntlMoneyFormatter(
            new \NumberFormatter('en_IN', NumberFormatter::CURRENCY),
            new ISOCurrencies
        );

        return $formatter->format($revenue);
    }
}
