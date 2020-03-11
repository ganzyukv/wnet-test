<?php

use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->load(__DIR__ . '/.env');

return [
    'paths'        => [
        'migrations' => __DIR__ . '/src/Migrations',
        'seeds'      => __DIR__ . '/src/Seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database'        => $_ENV['APP_ENV'],
        'develop'                 => [
            'adapter' => $_ENV['DB_ADAPTER'],
            'host'    => $_ENV['MYSQL_HOST'],
            'name'    => $_ENV['MYSQL_DATABASE'],
            'user'    => $_ENV['MYSQL_USER'],
            'pass'    => $_ENV['MYSQL_PASSWORD'],
            'port'    => $_ENV['MYSQL_PORT'],
            'charset' => 'utf8',
        ]
    ],
];
