<?php

namespace App\Repository;

use App\Entity\Hoja;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Hoja|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hoja|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hoja[]    findAll()
 * @method Hoja[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HojaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hoja::class);
    }

    // /**
    //  * @return Hoja[] Returns an array of Hoja objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hoja
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findHoja($id){
        return $this->createQueryBuilder('h')
            ->innerJoin('h.tipoActo', 'a')
            ->andWhere('a.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
