<?php


namespace App\Service;


use App\Entity\Carrier;
use App\Repository\CarrierRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Laminas\ServiceManager\ServiceManager;

class QuoteService
{
    public const CNPJ = '25438296000158';
    public const TOKEN = '1d52a9b6b78cf07b08586152459a5c90';
    public const CODE = '5AKVkHqCn';

    /** @var EntityManager */
    public EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;

    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function quote($data): array
    {
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
                "unitary_weight" => (float)$volume['price'] / 1000,
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
        $context['shipper'] = json_encode($shipper);
        $context['recipient'] = json_encode($recipient);
        $context['dispatchers'] = json_encode($dispatchers);
        $context['channel'] = "";
        $context['filter'] = 1;
        $context['limit'] = 0;
        $context['identification'] = "";
        $context['reverse'] = false;
        $context['simulation_type'] = [0];
        $context['returns'] = $returns;

        $responseBody = $this->post($context);
        foreach ($responseBody['carrier'] as $response) {
            $carrier = new Carrier();
            $carrier->setName((string)$response['name']);
            $carrier->setService((string)$response['service']);
            $carrier->setDeadline((int)$response['deadline']);
            $carrier->setPrice((float)$response['price']);

            $this->save($carrier);
        }

        return $responseBody;
    }

    /**
     * @param array $payload
     * @return \array[][]
     */
    public function post(array $payload)
    {
        $client = new Client([
            'base_uri' => 'https://sp.freterapido.com/api/v3/quote/simulate',
            'timeout' => 10,
            'connect_timeout' => 5,
            'headers' => [
                'Content-Type' => 'Application/JSON',
                'Accept' => 'Application/JSON'
            ]
        ]);

        $response = [
            'carrier' => [
                [
                    'name' => 'EXPRESSO FR',
                    'service' => 'Rodoviário',
                    'deadline' => '3',
                    'price' => 17
                ],
                [
                    'name' => 'Correios',
                    'service' => 'SEDEX',
                    'deadline' => 1,
                    'price' => 20.99
                ]
            ]
        ];

        return $response;

//        $response = $client->request('POST', '', ['json' => $payload]);
//        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param $entity
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save($entity): mixed
    {
        try {
            $this->em->persist($entity);
            $this->em->flush();
            return $entity;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @throws \Throwable
     * @throws \Doctrine\ORM\Exception\NotSupported
     */
    public function search($params): array|int|string
    {
        try {
            /** @var CarrierRepository $repository */
            $repository = $this->em->getRepository(CarrierRepository::class);
            return $repository->search($params);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}