<?php

namespace App\Repository;

use App\Entity\Test;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Test|null find($id, $lockMode = null, $lockVersion = null)
 * @method Test|null findOneBy(array $criteria, array $orderBy = null)
 * @method Test[]    findAll()
 * @method Test[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Test::class);
    }

    // /**
    //  * @return Test[] Returns an array of Test objects
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
    public function findOneBySomeField($value): ?Test
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findAllTest()
{
      $conn = $this->getEntityManager()->getConnection();
      $sql = 'select COUNT(*)  as nb from question,theme,test where question.theme_id=theme.id and question.test_id=test.id';
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetch();
    }
    
    public function findQuestion($id)
{
      $conn = $this->getEntityManager()->getConnection();
      $sql = 'select DISTINCT question,theme.id,question.id from question,theme,test where question.id=:id and theme.id=question.theme_id and test.theme_id=theme.id';
      $stmt = $conn->prepare($sql);
      $stmt->execute(['id' => $id]);
      return $stmt->fetch();
    }
    
    public function findChoix()
{
      $conn = $this->getEntityManager()->getConnection();
      $sql = 'select vocabulaire.libelle,vocabulaire.id from choix,question,vocabulaire where question.id=choix.question_id and vocabulaire.id=choix.choix_id';
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
    }
    
    public function findRep($number)
{
      $conn = $this->getEntityManager()->getConnection();
      $sql = 'select * from `choix` where choix.question_id = 1 and est_correct=1';
      $stmt = $conn->prepare($sql);
      $stmt->execute(['number' => $number]);
      return $stmt->fetch();
    }
}
