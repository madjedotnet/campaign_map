<?php

namespace App\Repository;

use App\Entity\Tiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tiles[]    findAll()
 * @method Tiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tiles::class);
    }

    // /**
    //  * @return Tiles[] Returns an array of Tiles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /**
     * Retourne une tuile en fonction de son id, pour l'API
     * 
     * @return Tiles
     */
    public function apiFindOneById($id): ?Tiles
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t.id', 't.scenery_id', 't.map_id', 't.coordinates', 't.army_id', 't.buildin_id')
            ->andWhere('t.id = :id')
            ->setParameter('id', $id)
        ;

        $query = $qb->getQuery();
        return $query->execute();
    }

    /**
     * Retourne la liste de toutes les tuiles en base
     * 
     * @return array
     */
    public function apiFindAll(): array
    {
        $qb = $this->createQueryBuilder('t')
            ->orderBy('t.coordinates', 'ASC');
        
        //$query = $qb->getQuery();
        //return $query->execute();
        //return $query->getResult();
        return $qb->getQuery()->getResult();
    }

    /**
     * Retourne une tuile en fonction de son id, pour l'API
     * 
     * @return array
     */
    public function findOneById($id): array
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t.id', 't.coordinates', 't.army')
            ->andWhere('t.id = :id')
            ->setParameter('id', $id)
        ;

        $query = $qb->getQuery();
        return $query->execute();
    }
}
