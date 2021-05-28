<?php

namespace App\Repository;

use App\Entity\MapsStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MapsStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method MapsStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method MapsStatus[]    findAll()
 * @method MapsStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MapsStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MapsStatus::class);
    }

    // /**
    //  * @return MapsStatus[] Returns an array of MapsStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MapsStatus
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
