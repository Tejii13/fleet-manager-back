<?php

namespace App\Repository;

use App\Entity\Preset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Preset>
 *
 * @method Preset|null find($id, $lockMode = null, $lockVersion = null)
 * @method Preset|null findOneBy(array $criteria, array $orderBy = null)
 * @method Preset[]    findAll()
 * @method Preset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Preset::class);
    }

//    /**
//     * @return Preset[] Returns an array of Preset objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Preset
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
