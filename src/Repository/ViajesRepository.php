<?php

namespace App\Repository;

use App\Entity\Viajes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Viajes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Viajes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Viajes[]    findAll()
 * @method Viajes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ViajesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Viajes::class);
    }

    /**
      * Encuentra los registros por el campo origen.
      * @return Viajes[] Returns an array of Viajes objects
      */
    public function findByOrigen($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.origen = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    /**
      * Encuentra los registros por el campo destino.
      * @return Viajes[] Returns an array of Viajes objects
      */
    public function findByDestino($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.destino = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
      * Encuentra un registro por el campo destino.
      * @return Regresa un objeto de tipo Viajes si encuentra el registro sino
     *  regresa nulo.
      */
    public function findOneByOrigenDestino($origen, $detino, $fecha)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.origen = :val')
            ->andWhere('v.destino = :val2')            
            ->andWhere('v.fecha = :val3')
            ->setParameter('val', $origen)
            ->setParameter('val2', $detino)
            ->setParameter('val3', $fecha)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    /*
    public function findOneBySomeField($value): ?Viajes
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
