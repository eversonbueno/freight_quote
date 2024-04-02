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
use Psr\Container\ContainerInterface;

class DoctrineORMFactory
{
    /**
     * @param ContainerInterface $container
     * @return EntityManager
     * @throws ORMException
     */
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $appConfig = $container->get('config');

        if (!isset($appConfig['doctrine']['connection']['orm_default'])) {
            throw new \RuntimeException("Missing doctrine connection config for orm_default driver");
        }

        $config = new Configuration;
        $config->setAutoGenerateProxyClasses($appConfig['doctrine']['connection']['orm']['auto_generate_proxy_classes'] ?: true);
        $config->setProxyDir($appConfig['doctrine']['connection']['orm']['proxy_dir'] ?: '/tmp/freight_quote/cache/proxies');
        $config->setProxyNamespace($appConfig['doctrine']['connection']['orm']['proxy_namespace'] ?: 'Api\Entity');
        $config->setNamingStrategy(new UnderscoreNamingStrategy);
        //AnnotationRegistry::registerFile(__DIR__ . '/../../../../vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
        /** @var ClassLoader $loader */
        $loader = require __DIR__.'/../../../../vendor/autoload.php';
        AnnotationRegistry::registerLoader([$loader, 'loadClass']);

        $driver = new AnnotationDriver(new AnnotationReader(), [ __DIR__ . '/../../Entity' ]);
        $config ->setMetadataDriverImpl($driver);

        return EntityManager::create($appConfig['doctrine']['connection']['orm_default'], $config);
    }
}