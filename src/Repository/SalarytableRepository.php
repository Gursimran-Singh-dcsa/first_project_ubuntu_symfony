<?php

namespace App\Repository;

use App\Entity\Salarytable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Salarytable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salarytable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salarytable[]    findAll()
 * @method Salarytable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalarytableRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Salarytable::class);
    }

    // /**
    //  * @return Salarytable[] Returns an array of Salarytable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Salarytable
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
