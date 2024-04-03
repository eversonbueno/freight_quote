<?php

namespace App\Handler;

use App\Handler\AliveHandler;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Laminas\EventManager\EventManager;
use Psr\Container\NotFoundExceptionInterface;

class AliveHandlerFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : AliveHandler
    {
        $events = new EventManager();
        $em = $container->get(EntityManager::class);

        return new AliveHandler($events, $em);
    }
}
