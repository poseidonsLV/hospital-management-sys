<?php

namespace App\Repository;

use App\Entity\Activepatients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activepatients|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activepatients|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activepatients[]    findAll()
 * @method Activepatients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivepatientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activepatients::class);
    }

    // /**
    //  * @return Activepatients[] Returns an array of Activepatients objects
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
    public function findOneBySomeField($value): ?Activepatients
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
