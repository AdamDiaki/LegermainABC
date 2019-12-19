<?php

namespace App\Repository;

use App\Entity\AccueilImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AccueilImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccueilImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccueilImage[]    findAll()
 * @method AccueilImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccueilImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccueilImage::class);
    }

    // /**
    //  * @return AccueilImage[] Returns an array of AccueilImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AccueilImage
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
