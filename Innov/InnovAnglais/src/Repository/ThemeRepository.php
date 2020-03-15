<?php

namespace App\Repository;

use App\Entity\Theme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Theme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Theme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Theme[]    findAll()
 * @method Theme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Theme::class);
    }

    // /**
    //  * @return Theme[] Returns an array of Theme objects
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
    public function findOneBySomeField($value): ?Theme
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findAllMotsByTheme($theme): array
{
      $conn = $this->getEntityManager()->getConnection();
      $sql = '
     
        select vocabulaire.libelle  
        from vocabulaire_theme,theme,vocabulaire 
        where theme.id=vocabulaire_theme.theme_id 
        and vocabulaire.id=vocabulaire_theme.vocabulaire_id 
        and vocabulaire_theme.theme_id=:theme
        ORDER BY nom ASC
        ';
      $stmt = $conn->prepare($sql);
      $stmt->execute(['theme' => $theme]);
      return $stmt->fetchAll();
    }
    
   
}
