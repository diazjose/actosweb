<?php

namespace App\Repository;

use App\Entity\TipoRol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoRol|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoRol|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoRol[]    findAll()
 * @method TipoRol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoRolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoRol::class);
    }

    // /**
    //  * @return TipoRol[] Returns an array of TipoRol objects
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
    public function findOneBySomeField($value): ?TipoRol
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
