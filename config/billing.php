<?php

return [
    'currency' => env('BILLING_CURRENCY', 'lkr'),

    'currency_locale' => env('BILLING_CURRENCY_LOCALE', 'si'),

    'paper' => env('BILLING_PAPER', 'letter'),

    'key_words' => [
        'price',
        'tax',
        'subtotal',
        'service',
        'total',
    ],
];
