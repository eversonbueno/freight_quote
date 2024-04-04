<?php


namespace App\Handler;


use App\Service\QuoteService;
use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\EventManager\EventManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class MetricsHandler extends AbstractRequestHandler
{
    public QuoteService $quoteService;

    /**
     * MetricsHandler constructor.
     * @param EventManagerInterface $events
     * @param EntityManager $em
     * @param QuoteService $quoteService
     */
    public function __construct(EventManagerInterface $events, EntityManager $em, QuoteService $quoteService)
    {
        parent::__construct($events, $em);

        $this->quoteService = $quoteService;

    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Throwable
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {

//            $data = \GuzzleHttp\json_decode($request->getBody(), true);

            $requestService = $this->quoteService->search();

            return new JsonResponse(['data' => $request, 'response_body' => $requestService]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage(), 'tracing_error' => $e->getTraceAsString()]);
        }
    }
}