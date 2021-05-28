<?php

namespace App\Repository;

use App\Entity\WarhammerSceneries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WarhammerSceneries|null find($id, $lockMode = null, $lockVersion = null)
 * @method WarhammerSceneries|null findOneBy(array $criteria, array $orderBy = null)
 * @method WarhammerSceneries[]    findAll()
 * @method WarhammerSceneries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WarhammerSceneriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WarhammerSceneries::class);
    }

    // /**
    //  * @return WarhammerSceneries[] Returns an array of WarhammerSceneries objects
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
    public function findOneBySomeField($value): ?WarhammerSceneries
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findOneById($id): array
    {
        $qb = $this->createQueryBuilder('ws')
            ->select('ws.id', 'ws.name')
            ->andWhere('ws.id = :id')
            ->setParameter('id', $id)
        ;

        $query = $qb->getQuery();
        return $query->execute();
    }
}
