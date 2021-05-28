<?php

namespace App\Repository;

use App\Entity\Armies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Armies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Armies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Armies[]    findAll()
 * @method Armies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArmiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Armies::class);
    }

    // /**
    //  * @return Armies[] Returns an array of Armies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Armies
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
