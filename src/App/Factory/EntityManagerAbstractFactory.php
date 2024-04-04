<?php


namespace App\Factory;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Psr\Container\ContainerInterface;

class EntityManagerAbstractFactory implements \Laminas\ServiceManager\AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        // Check if the requested service name is Doctrine\ORM\EntityManager
        return $requestedName === 'Doctrine\ORM\EntityManager';
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Retrieve the Doctrine configuration
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

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        // TODO: Implement canCreateServiceWithName() method.
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        // TODO: Implement createServiceWithName() method.
    }
}