<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'admin',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'admin',
        ],
    ],

    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Admin::class
        ]
    ]
];