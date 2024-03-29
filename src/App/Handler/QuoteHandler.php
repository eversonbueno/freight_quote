<?php


namespace App\Handler;


use App\Entity\Validate\CarrierValidate;
use App\Service\QuoteService;
use JMS\Serializer\SerializerBuilder;
use Laminas\Diactoros\Response\JsonResponse;
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

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {

            $data = \GuzzleHttp\json_decode($request->getBody(), true);

            $shipper = [
                'registered_number' => self::CNPJ,
                'token' => self::TOKEN,
                'platform_code' => self::CODE
            ];

            $recipient = [
                "type" => 0,
                "registered_number" => self::CNPJ,
                "state_inscription" => "",
                "country" => "",
                "zipcode" => 0
            ];

            $dispatchersVolume[] = [
                "amount" => 0,
                "amount_volumes" => 0,
                "category" => "",
                "sku" => "",
                "tag" => "",
                "description" => "",
                "height" => 0.0,
                "width" => 0.0,
                "length" => 0.0,
                "unitary_price" => 0.0,
                "unitary_weight" => 0.0,
                "consolidate" => false,
                "overlaid" => false,
                "rotate" => false
            ];

            $dispatchers[] = [
                "registered_number" => "",
                "zipcode" => 0,
                "total_price" => 0.0,
                "volumes" => $dispatchersVolume
            ];

            $returns = [
                "composition" => false,
                "volumes" => false,
                "applied_rules" => false
            ];

            $context = [];
            $context['shipper'] = $shipper;
            $context['recipient'] = $recipient;
            $context['dispatchers'] = $dispatchers;
            $context['channel'] = "";
            $context['filter'] = 0;
            $context['limit'] = 0;
            $context['identification'] = "";
            $context['reverse'] = false;
            $context['simulation_type'] = [0];
            $context['returns'] = $returns;

            return new JsonResponse(['data' => $data, 'context' => $context]);

        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage(), 'tracing_error' => $e->getTraceAsString()]);
        }
    }
}