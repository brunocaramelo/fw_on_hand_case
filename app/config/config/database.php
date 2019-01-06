<?php

return [
    'mysql' => [
        'host' => getenv('DB_HOST'),
        'database' => getenv('DB_DATABASE'),
        'user' => getenv('DB_USERNAME'),
        'pass' => getenv('DB_PASSWORD'),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'root_username' => getenv('DB_ROOT_USERNAME'),
        'root_pass' => getenv('DB_ROOT_PASSWORD'),
    ]
];
