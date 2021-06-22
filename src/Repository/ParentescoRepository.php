<?php

namespace App\Repository;

use App\Entity\Parentesco;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Parentesco|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parentesco|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parentesco[]    findAll()
 * @method Parentesco[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParentescoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parentesco::class);
    }

    // /**
    //  * @return Parentesco[] Returns an array of Parentesco objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Parentesco
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
