<?php

namespace App\Repository;

use App\Entity\PostcodeRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostcodeRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostcodeRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostcodeRating[]    findAll()
 * @method PostcodeRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostcodeRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostcodeRating::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PostcodeRating $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(PostcodeRating $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findByPostcode($postcode){
        $qb = $this->createQueryBuilder('PostcodeRating');
        $qb->select("PostcodeRating.rating_factor")
            ->where('PostcodeRating.postcode_area = :postcode')
            ->setParameter('postcode', $postcode);
        $result = $qb->getQuery()->getOneOrNullResult();

        return $result;
    }

    // /**
    //  * @return PostcodeRating[] Returns an array of PostcodeRating objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostcodeRating
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
