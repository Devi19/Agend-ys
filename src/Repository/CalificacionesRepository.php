<?php

namespace App\Repository;

use App\Entity\Calificaciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Calificaciones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calificaciones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calificaciones[]    findAll()
 * @method Calificaciones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalificacionesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Calificaciones::class);
    }

    // /**
    //  * @return Calificaciones[] Returns an array of Calificaciones objects
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

    /*
    public function findOneBySomeField($value): ?Calificaciones
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
