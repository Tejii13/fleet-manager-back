<?php

namespace App\Repository;

use App\Entity\Components;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Components>
 *
 * @method Components|null find($id, $lockMode = null, $lockVersion = null)
 * @method Components|null findOneBy(array $criteria, array $orderBy = null)
 * @method Components[]    findAll()
 * @method Components[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComponentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Components::class);
    }

//    /**
//     * @return Components[] Returns an array of Components objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Components
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
