<?php

namespace App\Repository;

use App\Entity\Rest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rest>
 *
 * @method Rest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rest[]    findAll()
 * @method Rest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rest::class);
    }

//    /**
//     * @return Rest[] Returns an array of Rest objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Rest
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
