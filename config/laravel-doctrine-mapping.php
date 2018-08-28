<?php

return [

    'profile' => 'default',

    'mapping_type' => 'yaml',

    "profiles" => [
        'default' => [
            'mapping_file_dir' => 'config/mappings/default',
            'entities_file_dir' => 'resources/classes/default',

            'connection' => 'mysql',
        ],

        'local' => [
            'isDevMode' => true,

            'mapping_file_dir' => 'config/mappings/local',
            'entities_file_dir' => 'resources/classes/local',

            'connection' => 'n2boost_mysql',
        ]
    ]
];
