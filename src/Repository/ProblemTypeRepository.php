<?php

namespace App\Repository;

use App\Entity\ProblemType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProblemType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProblemType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProblemType[]    findAll()
 * @method ProblemType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProblemTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProblemType::class);
    }

    // /**
    //  * @return ProblemType[] Returns an array of ProblemType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProblemType
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
