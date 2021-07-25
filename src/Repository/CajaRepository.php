<?php

namespace App\Repository;

use App\Entity\Caja;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Caja|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caja|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caja[]    findAll()
 * @method Caja[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CajaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caja::class);
    }

    // /**
    //  * @return Caja[] Returns an array of Caja objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findForActionIndex($filtro = [])
    {
      $qb = $this->createQueryBuilder('e');    
      
      // Este es un ejemplo de como se aplica un filtro.
      // El indice del array de $filtro hace referencia al valor que se aplicará
      // en este filtro si es que esta definido en el array y si no viene vacíozzzzzz
      if(isset($filtro["fechaIni"]) && $filtro["fechaIni"] != '') {
        $qb
          ->andWhere("e.fecha >= :fechaIni")
          ->setParameter("fechaIni", $filtro["fechaIni"])
        ;
      }
      if(isset($filtro["fechaFin"]) && $filtro["fechaFin"] != '') {
        $qb
          ->andWhere("e.fecha <= :fechaFin")
          ->setParameter("fechaFin", $filtro["fechaFin"])
        ;
      }

      if(isset($filtro["concepto"]) && $filtro["concepto"] != '') {
        $qb
          ->innerJoin('e.concepto', 'c')
          ->andWhere("c.id = :concepto")
          ->setParameter("concepto", $filtro["concepto"])
        ;
      }
      return $qb->orderBy('e.fecha', 'DESC')->getQuery()->getResult();
    }
    /*
    public function findOneBySomeField($value): ?Caja
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function todos()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
        //return $this->findBy(array(), array('fecha' => 'DESC'));
    }

    public function cajaDia()
    {
        return $this->createQueryBuilder('c')
            ->andWhere("c.fecha = :fecha")
            ->setParameter("fecha", date('Y-m-d'))
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
        //return $this->findBy(array(), array('fecha' => 'DESC'));
    }
}
