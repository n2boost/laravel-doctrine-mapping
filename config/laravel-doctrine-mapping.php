<?php

return [

    /*
     * Mapping Config Engines.
     * Can set to: yaml
     */

    'mapping_type' => 'yaml',

    /*
     * Mapping config files dir
     * full path will like this example: config/mappings/yaml/User.dcm.yml
     */
    'mapping_file_dir' => 'config/mappings',

    'entities_file_dir' => 'resources/classes',

    'profile' => 'local',
    'isDevMode' => true,

    'use_connection_pool' => 'laravel', // laravel, self
    'connection' => 'mysql',

    'connections' => [
        'mysql' => [
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
