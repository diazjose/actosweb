<?php

namespace App\Repository;

use App\Entity\DetallePresupuesto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DetallePresupuesto|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetallePresupuesto|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetallePresupuesto[]    findAll()
 * @method DetallePresupuesto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetallePresupuestoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetallePresupuesto::class);
    }

    // /**
    //  * @return DetallePresupuesto[] Returns an array of DetallePresupuesto objects
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
    public function findOneBySomeField($value): ?DetallePresupuesto
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findNombre($value){
        return $this->createQueryBuilder('d')
            ->andWhere('d.nombre = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
