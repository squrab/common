<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/6/14
 * Time: 14:22
 */

return [
    'redis' => [
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'password' => env('REDIS_PASSWORD', null),
        'port' => env('REDIS_PORT', 6379),
        'database' => env('REDIS_COMMON_DB', 10),
        'persistent' => true
    ],
    'encrypt' => [
        'ttl' => env('ENCRYPT_TTL', 7200),
        'iv' => env('ENCRYPT_IV', 'F6$elFe5QK$!902c'),
        'method' => env('ENCRYPT_METHOD', 'AES-128-CBC'),
        'key' => env('ENCRYPT_KEY', 'K%Xn3%@3XWs1f$!uR4TxXaiVpbNUhN^K')
    ],
    'baidu' => [
        'key' => env('BAIDU_KEY', null),
        'secret' => env('BAIDU_SECRET', null)
    ]
];
