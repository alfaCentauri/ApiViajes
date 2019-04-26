<?php

namespace App\Repository;

use App\Entity\viajesClientes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method viajesClientes|null find($id, $lockMode = null, $lockVersion = null)
 * @method viajesClientes|null findOneBy(array $criteria, array $orderBy = null)
 * @method viajesClientes[]    findAll()
 * @method viajesClientes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ViajesClienteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, viajesClientes::class);
    }

    // /**
    //  * @return viajesClientes[] Returns an array of viajesClientes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?viajesClientes
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
