<?php

namespace App\Entity;

use App\Entity\Acto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Acto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acto[]    findAll()
 * @method Acto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acto::class);
    }

    // /**
    //  * @return Acto[] Returns an array of Acto objects
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
    public function findOneBySomeField($value): ?Acto
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
