<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'toa',
        'password'    => 'toa123',
        'dbname'      => 'toa',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir'      => __DIR__ . '/../../app/models/',
        'migrationsDir'  => __DIR__ . '/../../app/migrations/',
        'viewsDir'       => __DIR__ . '/../../app/views/',
        'pluginsDir'     => __DIR__ . '/../../app/plugins/',
        'libraryDir'     => __DIR__ . '/../../app/library/',
        'cacheDir'       => __DIR__ . '/../../app/cache/',
        'vendor'         => __DIR__ . '/../../vendor/',
        'gameFolder'     => __DIR__ . '/../../games/',
        'assetFolder'    => __DIR__ . '/../../public/',
        'gameWebRoot' => '/games',
        'baseUri'        => '/',
    )
));

