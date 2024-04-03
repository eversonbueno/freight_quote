<?php

namespace App\Handler;

use Doctrine\ORM\EntityManager;
use Laminas\EventManager\EventManagerInterface;
use mysql_xdevapi\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\EventManager\EventManager;
use App\Handler\AbstractRequestHandler;
use Psr\Http\Server\RequestHandlerInterface;

class AliveHandler implements RequestHandlerInterface
{
    /** @var EventManagerInterface */
    public EventManagerInterface $events;

    /** @var EntityManager */
    public EntityManager $em;

    public function __construct(EventManagerInterface $events, EntityManager $em)
    {
//        parent::__construct($events, $em);
        $this->events = $events;
        $this->em = $em;
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $message = [
            'database_is_connected' => $this->em->getConnection()->connect()
        ];

        return new JsonResponse($message);
    }
}
