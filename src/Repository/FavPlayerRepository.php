<?php

namespace App\Repository;

use App\Entity\FavPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FavPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavPlayer[]    findAll()
 * @method FavPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavPlayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FavPlayer::class);
    }

    // /**
    //  * @return FavPlayer[] Returns an array of FavPlayer objects
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
    public function findOneBySomeField($value): ?FavPlayer
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
