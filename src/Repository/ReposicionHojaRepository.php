<?php

namespace App\Repository;

use App\Entity\ReposicionHoja;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReposicionHoja|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReposicionHoja|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReposicionHoja[]    findAll()
 * @method ReposicionHoja[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReposicionHojaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReposicionHoja::class);
    }

    // /**
    //  * @return ReposicionHoja[] Returns an array of ReposicionHoja objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReposicionHoja
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
