<?php

use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->load(__DIR__ . '/.env');

return [
    'paths'        => [
        'migrations' => __DIR__ . 'src/Migrations',
        'seeds'      => __DIR__ . 'src/Seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database'        => $_ENV['APP_ENV'],
        'develop'                 => [
            'adapter' => $_ENV['DB_ADAPTER'],
            'host'    => $_ENV['DB_HOST'],
            'name'    => $_ENV['DB_NAME'],
            'user'    => $_ENV['DB_USER'],
            'pass'    => $_ENV['DB_PASS'],
            'port'    => $_ENV['DB_PORT'],
            'charset' => 'utf8',
        ]
    ],
];
