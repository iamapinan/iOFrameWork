<?php
// load our environment files - used to store credentials & configuration
(new Dotenv\Dotenv(__DIR__))->load();

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/storage/db/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/storage/db/seeds',
        ],
        'environments' =>
            [
                'default_database' => 'development',
                'default_migration_table' => 'phinxlog',
                'development'      =>
                    [
                        'adapter' => 'mysql',
                        'host' => getenv('mysql_host'),
                        'name' => getenv('mysql_database_name'),
                        'user' => getenv('mysql_user'),
                        'pass' => getenv('mysql_password'),
                        'port' => getenv('mysql_port'),
                        'server' => getenv('mysql_host'),
                        'database_name' => getenv('mysql_database_name'),
                        'database_type' => 'mysql',
                        'charset' => 'utf8',
                    ],
            ],
    ];

