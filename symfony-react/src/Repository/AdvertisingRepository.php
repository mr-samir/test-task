<?php

namespace App\Repository;

use App\Entity\Advertising;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Advertising|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advertising|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advertising[]    findAll()
 * @method Advertising[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertisingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Advertising::class);
    }

    /**
     * @param $advId
     * @return Advertising|null
     */
    public function findOneById($advId): ?Advertising
    {
        try {
            return $this->createQueryBuilder('a')
                ->andWhere('a.id = :id')
                ->setParameter('id', $advId)
                ->getQuery()
                ->getOneOrNullResult()
                ;
        } catch (\Doctrine\ORM\NonUniqueResultException $ex) {
            return null;
        }
    }

    /**
     * @param $slotElementId
     * @return Advertising|null
     */
    public function findOneBySlotElementId($slotElementId): ?Advertising
    {
        try {
            return $this->createQueryBuilder('a')
                ->andWhere('a.slot_element_id = :slot_element_id')
                ->setParameter('slot_element_id', $slotElementId)
                ->getQuery()
                ->getOneOrNullResult()
                ;
        } catch (\Doctrine\ORM\NonUniqueResultException $ex) {
            return null;
        }
    }
}
