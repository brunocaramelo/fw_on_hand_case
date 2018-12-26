<?php

return [

    /* Options (mysql, sqlite) */
    'driver' => 'sqlite',

    'sqlite' => [
        'database' => 'database.db'
    ],

    'mysql' => [
        'host' => getenv('DB_HOST'),
        'database' => getenv('DB_DATABASE'),
        'user' => getenv('DB_USERNAME'),
        'pass' => getenv('DB_PASSWORD'),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci'
    ]
];