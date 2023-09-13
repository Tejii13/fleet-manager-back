<?php

namespace App\Repository;

use App\Entity\Loadout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Loadout>
 *
 * @method Loadout|null find($id, $lockMode = null, $lockVersion = null)
 * @method Loadout|null findOneBy(array $criteria, array $orderBy = null)
 * @method Loadout[]    findAll()
 * @method Loadout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoadoutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Loadout::class);
    }

//    /**
//     * @return Loadout[] Returns an array of Loadout objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Loadout
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
