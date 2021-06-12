<?php

namespace App\Entity;

use App\Entity\EstadoActo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EstadoActo|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoActo|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoActo[]    findAll()
 * @method EstadoActo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoActoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoActo::class);
    }

    // /**
    //  * @return EstadoActo[] Returns an array of EstadoActo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EstadoActo
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
