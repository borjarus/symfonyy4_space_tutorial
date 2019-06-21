<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

//    /**
//     * @return Article[] Returns an array of Article objects
//     */
    
    public function findByPublishedOrderByNewest()
    {
        return $this->addIsPublishedQueryBuilder()
            ->leftJoin('a.tags', 't')
            ->addSelect('t')
            ->andWhere('a.publishedAt IS NOT NULL')
            ->orderBy('a.publishedAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public static function creteNonDeletedCriteria() : Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->eq('isDeleted', false))
            ->orderBy(['createdAt' => 'DESC']);
    }
    

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    private function addIsPublishedQueryBuilder(QueryBuilder $qb = null)   
    {
        return $this->getOrCreateQueryBuileder($qb)
                ->andWhere('a.publishedAt IS NOT NULL');
    }

    private function getOrCreateQueryBuileder(QueryBuilder $qb = null)
    {
        return $qb ?: $this->createQueryBuilder('a');
    }
}
