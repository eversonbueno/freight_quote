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

            $price = 0;
            $dispatchersVolume = [];
            foreach ($data['volumes'] as $volume) {
                $price += $volume['price'];
                $dispatchersVolume[] = [
                    "amount" => $volume['amount'],
                    "amount_volumes" => count($data['volumes']),
                    "category" => (string)$volume['category'],
                    "sku" => $volume['sku'],
                    "tag" => "",
                    "description" => "",
                    "height" => (float)$volume['height'],
                    "width" => (float)$volume['width'],
                    "length" => (float)$volume['length'],
                    "unitary_price" => (float)$volume['price'],
                    "unitary_weight" => (float)$volume['price']/1000,
                    "consolidate" => false,
                    "overlaid" => false,
                    "rotate" => false
                ];
            }

            $shipper = [
                'registered_number' => self::CNPJ,
                'token' => self::TOKEN,
                'platform_code' => self::CODE
            ];

            $recipient = [
                "type" => 0,
                "registered_number" => self::CNPJ,
                "state_inscription" => "",
                "country" => "BRA",
                "zipcode" => (int)$data['recipient']['address']['zipcode']
            ];

            $dispatchers[] = [
                "registered_number" => self::CNPJ,
                "zipcode" => (int)$data['recipient']['address']['zipcode'],
                "total_price" => (float)$price,
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
            $context['filter'] = 1;
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