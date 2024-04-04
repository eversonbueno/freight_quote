<?php

namespace App\Doctrine\Factory;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\ClassLoader;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;

class DoctrineORMFactory
{
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws ORMException
     */
    public function __invoke(ContainerInterface $container): EntityManager
    {
        // Recuperar configurações do Doctrine do arquivo de configuração
        $config = $container->get('config')['doctrine'];

        if (!isset($config['connection']['orm_default'])) {
            throw new \RuntimeException("Missing doctrine connection config for orm_default driver");
        }

        // Configurações de conexão com o banco de dados
        $connectionParams = [
            'driver'   => $config['connection']['orm_default']['params']['driver'],
            'host'     => $config['connection']['orm_default']['params']['host'],
            'dbname'   => $config['connection']['orm_default']['params']['dbname'],
            'user'     => $config['connection']['orm_default']['params']['user'],
            'password' => $config['connection']['orm_default']['params']['password'],
        ];

        // Configurações do Doctrine ORM
        $doctrineConfig = Setup::createAnnotationMetadataConfiguration(
            $config['entity_paths'], // Paths para as entidades
            $config['dev_mode'],     // Modo de desenvolvimento
            null,                    // Proxy directory (opcional)
            null,                    // Proxy namespace (opcional)
            false                    // Auto-generate proxy classes (opcional)
        );

        // Cria e retorna o EntityManager
        return EntityManager::create($connectionParams, $doctrineConfig);
    }
}