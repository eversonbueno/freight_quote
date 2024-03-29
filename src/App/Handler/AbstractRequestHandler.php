<?php

namespace App\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\EventManager\EventManagerInterface;

abstract class AbstractRequestHandler implements RequestHandlerInterface
{
    public EventManagerInterface $events;
    public EntityManager $em;

    /**
     * AbstractRequestHandler constructor.
     * @param EventManagerInterface $events
     * @param EntityManager $em
     */
    public function __construct(EventManagerInterface $events, EntityManager $em)
    {
        $this->events = $events;
        $this->em = $em;
    }

    /**
     * @param $eventName
     * @param null $target
     * @param array $argv
     */
    public function trigger($eventName, $target = null, array $argv = [])
    {
        $this->events->trigger($eventName, $target, $argv);
    }
}
