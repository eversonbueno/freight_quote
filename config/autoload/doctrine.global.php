<?php
declare(strict_types=1);

use Doctrine\Common\Cache\FilesystemCache;
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
                'repository_class' => \App\Repository\CarrierRepository::class,
                'driver_class' => Driver::class,
                'params' => [
                    'driver'   => 'pdo_mysql',
                    'host'     => 'localhost',
                    'port'     => 3306,
                    'user'     => 'root',
                    'password' => 'Angelica@1714',
                    'dbname'   => 'api_freight_quote',
                ],
            ],
        ],

        'entitymanager' => [
            'orm_default' => array(
                'connection'    => 'orm_default'
            )
        ],

        'entity_paths' => [
            'src/App/Entity',
        ],
        'dev_mode' => true, // Defina como true se estiver em ambiente de desenvolvimento

        'driver' => [
            'orm_default' => [
                'drivers' => [
                    'App\Entity' => [
                        'class' => AnnotationDriver::class,
                        'paths' => [
                            'src/App/Entity',
                        ],
                    ],
                ],
            ],
        ],
        'cache' => [
            'class' => FilesystemCache::class,
            'directory' => 'data/cache/DoctrineCache',
        ],
    ],
];