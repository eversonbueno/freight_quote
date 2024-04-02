<?php
declare(strict_types=1);

use Doctrine\DBAL\Driver\PDO\MySQL\Driver;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm' => [
                'auto_generate_proxy_classes' => true,
                'proxy_dir' => '/tmp',
                'proxy_namespace' => 'App\Entity',
            ],
            'orm_default' => [
                'driver_class' => Driver::class,
                'params' => [
                    'host'     => 'localhost',
                    'port'     => 3306,
                    'user'     => 'root',
                    'password' => 'Angelica@1714',
                    'dbname'   => 'api_freight_quote',
                ],
            ],
        ],

        'driver' => [
            'orm_default' => [
                'drivers' => [
                    'App\Entity' => [
                        'class' => AnnotationDriver::class,
                        'paths' => [
                            'src/Entity',
                        ],
                    ],
                ],
            ],
        ],
    ],
];