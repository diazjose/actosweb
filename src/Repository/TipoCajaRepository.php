<?php

namespace App\Repository;

use App\Entity\TipoCaja;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoCaja|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoCaja|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoCaja[]    findAll()
 * @method TipoCaja[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoCajaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoCaja::class);
    }

    // /**
    //  * @return TipoCaja[] Returns an array of TipoCaja objects
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

    /*
    public function findOneBySomeField($value): ?TipoCaja
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
