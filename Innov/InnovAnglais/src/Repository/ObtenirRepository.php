<?php

namespace App\Repository;

use App\Entity\Obtenir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Obtenir|null find($id, $lockMode = null, $lockVersion = null)
 * @method Obtenir|null findOneBy(array $criteria, array $orderBy = null)
 * @method Obtenir[]    findAll()
 * @method Obtenir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObtenirRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Obtenir::class);
    }

    // /**
    //  * @return Obtenir[] Returns an array of Obtenir objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Obtenir
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
