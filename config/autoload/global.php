<?php

return [
    'service_manager' => [
        'factories' => [
            Doctrine\ORM\EntityManager::class => App\Factory\EntityManagerFactory::class,
        ],
    ],
    'doctrine' => [
        'dev_mode' => true, // Defina como false em produção
        'connection' => [
            // Configurações da conexão com o banco de dados
            'host'     => 'localhost',
            'port'     => 3306,
            'user'     => 'root',
            'password' => 'Angelica@1714',
            'dbname'   => 'api_freight_quote',
        ],
        'metadata_dirs' => [
            // Diretórios onde estão as entidades do Doctrine
            __DIR__ . 'src/App/Entity',
        ],
    ],
];