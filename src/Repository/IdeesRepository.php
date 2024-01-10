<?php

namespace App\Repository;

use App\Entity\Idees;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Idees>
 *
 * @method Idees|null find($id, $lockMode = null, $lockVersion = null)
 * @method Idees|null findOneBy(array $criteria, array $orderBy = null)
 * @method Idees[]    findAll()
 * @method Idees[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Idees::class);
    }

//    /**
//     * @return Idees[] Returns an array of Idees objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Idees
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
