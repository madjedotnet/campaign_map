<?php

namespace App\Repository;

use App\Entity\Maps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Maps|null find($id, $lockMode = null, $lockVersion = null)
 * @method Maps|null findOneBy(array $criteria, array $orderBy = null)
 * @method Maps[]    findAll()
 * @method Maps[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MapsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maps::class);
    }

    // /**
    //  * @return Maps[] Returns an array of Maps objects
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
    public function findOneBySomeField($value): ?Maps
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Maps Returns a Map object
     */
    public function findOneByIdOrderByCoordinates($id): ?Maps
    {
        // $test = $this->createQueryBuilder('map')
        //     ->andWhere('map.id = :id')
        //     ->setParameter('id', $id)
        //     //->orderBy('map.tile.coordinates', 'ASC')
        //     //->orderBy('coordinates', 'ASC')
        //     ->getQuery()
        //     ->getOneOrNullResult()
        // ;

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT t, a
            FROM App\Entity\Tiles t
            INNER JOIN App\Entity\Armies a
            WHERE t.map = :id
            ORDER BY coordinates'
        )->setParameter('id', $id);

        return $query->getQuery();

    }
}
