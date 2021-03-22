<?php

namespace App\Repository;

use App\Entity\Fix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fix|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fix|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fix[]    findAll()
 * @method Fix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fix::class);
    }

    // /**
    //  * @return Fix[] Returns an array of Fix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fix
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
