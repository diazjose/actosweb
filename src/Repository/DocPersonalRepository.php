<?php

namespace App\Repository;

use App\Entity\DocPersonal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DocPersonal|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocPersonal|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocPersonal[]    findAll()
 * @method DocPersonal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocPersonalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocPersonal::class);
    }

    // /**
    //  * @return DocPersonal[] Returns an array of DocPersonal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DocPersonal
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
