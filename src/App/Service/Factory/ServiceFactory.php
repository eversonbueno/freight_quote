<?php


namespace App\Service\Factory;


use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
//use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\ServiceManager;
use Psr\Container\NotFoundExceptionInterface;

class ServiceFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $service)
    {
        $em = $container->get(EntityManager::class);
        $sm = $container->get(ServiceManager::class);
        return new $service($em, $sm);
    }
}