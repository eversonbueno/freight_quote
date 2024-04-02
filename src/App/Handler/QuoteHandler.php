<?php


namespace App\Handler;


use App\Entity\Carrier;
use App\Entity\Validate\CarrierValidate;
use App\Service\QuoteService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\SerializerBuilder;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\EventManager\EventManagerInterface;
use Laminas\ServiceManager\ServiceManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Validator\Validation;

class QuoteHandler implements RequestHandlerInterface
{
    public const CNPJ = '25438296000158';
    public const TOKEN = '1d52a9b6b78cf07b08586152459a5c90';
    public const CODE = '5AKVkHqCn';

    /** @var QuoteService */
    public QuoteService $quoteService;

    /**
     * QuoteHandler constructor.
     * @param $quoteService
     */
    public function __construct($quoteService)
    {
        $this->quoteService = $quoteService;

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {

            $data = \GuzzleHttp\json_decode($request->getBody(), true);

            $requestService = $this->quoteService->quote($data);

            return new JsonResponse(['data' => $data, 'response_body' => $requestService]);

        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage(), 'tracing_error' => $e->getTraceAsString()]);
        }
    }
}