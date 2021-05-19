<?php

namespace App\Repository;

use App\Entity\BraveChef;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BraveChef|null find($id, $lockMode = null, $lockVersion = null)
 * @method BraveChef|null findOneBy(array $criteria, array $orderBy = null)
 * @method BraveChef[]    findAll()
 * @method BraveChef[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BraveChefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BraveChef::class);
    }

    // /**
    //  * @return BraveChef[] Returns an array of BraveChef objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BraveChef
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
