<?php

namespace App\Repository;

use App\Entity\FavClubs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FavClubs|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavClubs|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavClubs[]    findAll()
 * @method FavClubs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavClubsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FavClubs::class);
    }

    // /**
    //  * @return FavClubs[] Returns an array of FavClubs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FavClubs
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
