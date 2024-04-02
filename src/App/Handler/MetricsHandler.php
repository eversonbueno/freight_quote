<?php


namespace App\Handler;


use App\Service\QuoteService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class MetricsHandler implements RequestHandlerInterface
{
    /** @var QuoteService */
    public QuoteService $quoteService;

    /**
     * MetricsHandler constructor.
     * @param $quoteService
     */
    public function __construct($quoteService)
    {
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

            $requestService = $this->quoteService->search([]);

            return new JsonResponse(['data' => $request, 'response_body' => $requestService]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage(), 'tracing_error' => $e->getTraceAsString()]);
        }
    }
}