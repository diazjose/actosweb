<?php

namespace App\Repository;

use App\Entity\LugarActo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LugarActo|null find($id, $lockMode = null, $lockVersion = null)
 * @method LugarActo|null findOneBy(array $criteria, array $orderBy = null)
 * @method LugarActo[]    findAll()
 * @method LugarActo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LugarActoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LugarActo::class);
    }

    // /**
    //  * @return LugarActo[] Returns an array of LugarActo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LugarActo
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
