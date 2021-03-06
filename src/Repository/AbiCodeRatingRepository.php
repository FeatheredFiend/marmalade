<?php

namespace App\Repository;

use App\Entity\AbiCodeRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AbiCodeRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbiCodeRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbiCodeRating[]    findAll()
 * @method AbiCodeRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbiCodeRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AbiCodeRating::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(AbiCodeRating $entity, bool $flush = true): void
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
    public function remove(AbiCodeRating $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findByABI($abi){
        $qb = $this->createQueryBuilder('AbiCodeRating');
        $qb->select("AbiCodeRating.rating_factor")
            ->where('AbiCodeRating.abi_code = :abi')
            ->setParameter('abi', $abi);
        $result = $qb->getQuery()->getOneOrNullResult();

        return $result;
    }

    // /**
    //  * @return AbiCodeRating[] Returns an array of AbiCodeRating objects
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
    public function findOneBySomeField($value): ?AbiCodeRating
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
