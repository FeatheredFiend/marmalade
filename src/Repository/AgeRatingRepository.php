<?php

namespace App\Repository;

use App\Entity\AgeRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AgeRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgeRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgeRating[]    findAll()
 * @method AgeRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgeRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgeRating::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(AgeRating $entity, bool $flush = true): void
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
    public function remove(AgeRating $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findByAge($age){
        $qb = $this->createQueryBuilder('AgeRating');
        $qb->select("AgeRating.rating_factor")
            ->where('AgeRating.age = :age')
            ->setParameter('age', $age);
        $result = $qb->getQuery()->getOneOrNullResult();

        return $result;
    }

    // /**
    //  * @return AgeRating[] Returns an array of AgeRating objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AgeRating
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
