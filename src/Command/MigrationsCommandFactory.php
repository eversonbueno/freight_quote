<?php

namespace Command;

use Doctrine\ORM\EntityManager;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\DoctrineCommand;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container;

class MigrationsCommandFactory implements \Laminas\ServiceManager\Factory\FactoryInterface
{
    /**
     * @inheritDoc
     *
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     *
     * @return DoctrineCommand
     *
     */
    public function __invoke(ContainerInterface|Container\ContainerInterface $container, $requestedName, ?array $options = null): DoctrineCommand {
        /** @var array $config */
        $config = $container->get('config')['doctrine']['migrations']['orm_default'];

        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);

        return new $requestedName(
            DependencyFactory::fromEntityManager(
                new ConfigurationArray($config),
                new ExistingEntityManager($entityManager)
            )
        );
    }
}