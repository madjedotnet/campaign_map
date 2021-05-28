<?php

namespace App\Repository;

use App\Entity\WarhammerArmies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WarhammerArmies|null find($id, $lockMode = null, $lockVersion = null)
 * @method WarhammerArmies|null findOneBy(array $criteria, array $orderBy = null)
 * @method WarhammerArmies[]    findAll()
 * @method WarhammerArmies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WarhammerArmiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WarhammerArmies::class);
    }

    // /**
    //  * @return WarhammerArmies[] Returns an array of WarhammerArmies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WarhammerArmies
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
