<?php

return [
    'environment' => env('LEMANAPRO_ENV', 'production'),

    'environments' => [

        'production' => [
            'base_url' => 'https://api.lemanapro.ru:443',
            'auth_url' => 'https://partners.auth.lemanapro.ru/realms/partner/protocol/openid-connect/token',
        ],

        'sandbox' => [
            'base_url' => 'https://api-test.lemanapro.ru:443',
            'auth_url' => 'https://partners.auth.lemanapro.ru/realms/partner/protocol/openid-connect/token',
        ],

        'debug' => [
            'base_url' => 'http://localhost:8080',
            'auth_url' => 'http://localhost:8081/token',
        ],

    ],

    'client_id' => env('LEMANAPRO_CLIENT_ID'),
    'client_secret' => env('LEMANAPRO_CLIENT_SECRET'),

    'http' => [
        'timeout' => 10,
        'retry' => [
            'times' => 3,
            'sleep_ms' => 300,
        ],
    ],
];

