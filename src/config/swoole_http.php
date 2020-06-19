<?php

return [
    /*
    |--------------------------------------------------------------------------
    | HTTP server configurations.
    |--------------------------------------------------------------------------
    |
    | @see https://www.swoole.co.uk/docs/modules/swoole-server/configuration
    |
    */
    'server' => [
        'host' => '127.0.0.1',
        'port' => '1215',
        'app_name' => 'Slim Swoole',
        'public_path' => 'public',
        // Determine if to use swoole to respond request for static files
        'handle_static_files' => true,
        'access_log' => 'false',
        // You must add --enable-openssl while compiling Swoole
        // Put `SWOOLE_SOCK_TCP | SWOOLE_SSL` if you want to enable SSL
        'socket_type' => SWOOLE_SOCK_TCP,
        'process_type' => SWOOLE_PROCESS,
        'options' => [
            'pid_file' => '',
            'log_file' => '',
            'daemonize' => '',
            // Normally this value should be 1~4 times larger according to your cpu cores.
            'reactor_num' => '',
            'worker_num' => '',
            'task_worker_num' => '',
            // The data to receive can't be larger than buffer_output_size.
            'package_max_length' => 20 * 1024 * 1024,
            // The data to send can't be larger than buffer_output_size.
            'buffer_output_size' => 10 * 1024 * 1024,
            // Max buffer size for socket connections
            'socket_buffer_size' => 128 * 1024 * 1024,
            // Worker will restart after processing this number of requests
            'max_request' => 3000,
            // Enable coroutine send
            'send_yield' => true,
            // You must add --enable-openssl while compiling Swoole
            'ssl_cert_file' => null,
            'ssl_key_file' => null,
        ],
    ],
];
