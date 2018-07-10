<?php

return [
    'mapping_type' => 'yaml',
    'mapping_file_dir' => 'config/mappings',
    'entities_file_dir' => 'resources/classes',

    'profile' => 'local',
    'isDevMode' => true,

    'use_connection_pool' => 'self', // laravel, self
    'connection' => 'local',

    'connections' => [
        'local' => [
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => '',
            'dbname' => 'hunter',
            'charset' => 'utf8mb4',
            'collate' => 'utf8mb4_unicode_ci',
        ]
    ]
];
