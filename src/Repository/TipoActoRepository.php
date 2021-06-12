<?php

namespace App\Repository;

use App\Entity\TipoActo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoActo|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoActo|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoActo[]    findAll()
 * @method TipoActo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoActoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoActo::class);
    }

    // /**
    //  * @return TipoActo[] Returns an array of TipoActo objects
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
    public function findOneBySomeField($value): ?TipoActo
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
