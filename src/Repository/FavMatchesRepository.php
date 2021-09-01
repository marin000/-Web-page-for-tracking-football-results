<?php

namespace App\Repository;

use App\Entity\FavMatches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FavMatches|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavMatches|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavMatches[]    findAll()
 * @method FavMatches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavMatchesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FavMatches::class);
    }

    // /**
    //  * @return FavMatches[] Returns an array of FavMatches objects
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

    
    public function findMatchByMatchId($value,$user): ?FavMatches
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.matchId = :val','f.userId = :user')
            ->setParameter('val', $value)
            ->setParameter('user',$user)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
