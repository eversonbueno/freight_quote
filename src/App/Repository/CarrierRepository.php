<?php


namespace App\Repository;


use App\Entity\Carrier;
use Doctrine\ORM\EntityRepository;
use Throwable;

class CarrierRepository extends EntityRepository
{
    /**
     * @return int|array|string
     * @throws Throwable
     */
    public function search(): array|int|string
    {
        try {
            $qb = $this->getEntityManager()->createQueryBuilder();
            $qb->select('c')
                ->from(Carrier::class, 'c');
            return $qb->getQuery()->getArrayResult();
        } catch (Throwable $e) {
            throw $e;
        }
    }
}