<?php

namespace App\Repository;

use App\Entity\NosPlats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NosPlats|null find($id, $lockMode = null, $lockVersion = null)
 * @method NosPlats|null findOneBy(array $criteria, array $orderBy = null)
 * @method NosPlats[]    findAll()
 * @method NosPlats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NosPlatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NosPlats::class);
    }

    // /**
    //  * @return NosPlats[] Returns an array of NosPlats objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NosPlats
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
