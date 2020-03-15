<?php

namespace App\Repository;

use App\Entity\Vocabulaire;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vocabulaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vocabulaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vocabulaire[]    findAll()
 * @method Vocabulaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VocabulaireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vocabulaire::class);
    }

    // /**
    //  * @return Vocabulaire[] Returns an array of Vocabulaire objects
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
    public function findOneBySomeField($value): ?Vocabulaire
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findAllFilesByUser($user): array
{
      $conn = $this->getEntityManager()->getConnection();
      $sql = '
        select *
        from vocabulaire_theme,theme,vocabulaire 
        where theme.id=vocabulaire_theme.theme_id 
        and vocabulaire.id=vocabulaire_theme.vocabulaire_id 
        and vocabulaire_theme.theme_id=:theme
        ORDER BY nom ASC
        ';
      $stmt = $conn->prepare($sql);
      $stmt->execute(['theme' => $user]);
      return $stmt->fetchAll();
    }

}
