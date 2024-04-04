<?php


namespace App\Factory;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Tools\Setup;
//use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class EntityManagerFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ORMException
     */
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $config = $container->get('config')['doctrine']; // Assuming your doctrine configuration is under 'doctrine' key

        // Paths to your entities
        $entityPaths = $config['entity_paths'] ?? [];

        // Database connection configuration
        $connectionParams = $config['connection'] ?? [];

        // Create Doctrine ORM configuration
        $isDevMode = $config['dev_mode'] ?? false;
        $doctrineConfig = Setup::createAnnotationMetadataConfiguration(
            $entityPaths,
            $isDevMode
        );

        // Create EntityManager
        return EntityManager::create($connectionParams, $doctrineConfig);
    }
}