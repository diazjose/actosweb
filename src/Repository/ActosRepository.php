<?php

namespace App\Repository;

use App\Entity\Acto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Actos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actos[]    findAll()
 * @method Actos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acto::class);
    }

    // /**
    //  * @return Actos[] Returns an array of Actos objects
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
    public function findOneBySomeField($value): ?Actos
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
