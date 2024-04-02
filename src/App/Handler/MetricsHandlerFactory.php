<?php


namespace App\Handler;


use App\Service\QuoteService;
use Doctrine\ORM\EntityManager;
use Laminas\EventManager\EventManager;
use PhpParser\Node\Expr\New_;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MetricsHandlerFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $quoteService = $container->get(QuoteService::class);

        return new MetricsHandler($quoteService);

    }
}