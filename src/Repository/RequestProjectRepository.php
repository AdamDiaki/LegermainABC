<?php

namespace App\Repository;

use App\Entity\RequestProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RequestProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method RequestProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method RequestProject[]    findAll()
 * @method RequestProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequestProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RequestProject::class);
    }

    // /**
    //  * @return RequestProject[] Returns an array of RequestProject objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RequestProject
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
