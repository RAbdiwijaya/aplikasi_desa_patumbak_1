<?php

return [

    'name' => env('APP_NAME', 'Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),

    // Trusted proxies untuk Railway
    'trusted_proxies' => [
        '10.0.0.0/8',
        '127.0.0.1/8',
        '172.16.0.0/12',
        '192.168.0.0/16',
        '::1',
        '*.railway.app',
        '.railway.app'
    ],

    // Trusted hosts untuk security
    'trusted_hosts' => [
        '.*\.railway\.app',
        '.*\.up\.railway\.app',
    ],

    'timezone' => 'Asia/Jakarta',
    'locale' => env('APP_LOCALE', 'id'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'id'),
    'faker_locale' => env('APP_FAKER_LOCALE', 'id_ID'),

    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),
    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
