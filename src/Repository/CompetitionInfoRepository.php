<?php

namespace App\Repository;

use App\Entity\CompetitionInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompetitionInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetitionInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetitionInfo[]    findAll()
 * @method CompetitionInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetitionInfoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompetitionInfo::class);
    }

    // /**
    //  * @return CompetitionInfo[] Returns an array of CompetitionInfo objects
    //  */
    
    public function findByCompetitionId($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.CompId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?CompetitionInfo
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
