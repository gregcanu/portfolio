<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Item::class);
    }
    
    // Retourne tous les items dans un tableau
    public function findAllItems() {
        return $this->createQueryBuilder('i')
                        ->getQuery()
                        ->getArrayResult()
        ;
    }
    
    // Retourne un item selon son id dans un tableau
    public function findItem($id) {
        $item = $this->createQueryBuilder('i')
                    ->where('i.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()
                    ->getArrayResult()
        ;
        
        return $item[0];
    }

    // /**
    //  * @return Item[] Returns an array of Item objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('i')
      ->andWhere('i.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('i.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      public function findOneBySomeField($value): ?Item
      {
      return $this->createQueryBuilder('i')
      ->andWhere('i.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
