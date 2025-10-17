<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    //    /**
    //     * @return Author[] Returns an array of Author objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Author
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    // getAuthor By NAme DQL
    public function findAuthorByName($nameValue)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT a From App\Entity\Author a WHERE a.username=:nameparam')
            ->setParameter('nameparam', $nameValue);
        return $query->getResult();
    }


    // get author where nbBouk is between min and max

    public function filterByMinMax($min, $max)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT a From App\Entity\Author a WHERE a.nbBook BETWEEN :min AND :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max);
        return $query->getResult();
    }
}
