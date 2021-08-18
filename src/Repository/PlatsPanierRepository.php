<?php

namespace App\Repository;

use App\Entity\PlatsPanier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlatsPanier|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlatsPanier|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlatsPanier[]    findAll()
 * @method PlatsPanier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatsPanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlatsPanier::class);
    }

    // /**
    //  * @return PlatsPanier[] Returns an array of PlatsPanier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlatsPanier
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
