<?php

return [
    'api_key' => env('LEMANAPRO_API_KEY'),

    'http' => [
        'timeout' => 10,
        'retry' => [
            'times' => 3,
            'sleep_ms' => 300,
        ],
    ],
];

