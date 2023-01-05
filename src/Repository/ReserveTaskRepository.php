<?php

namespace App\Repository;

use App\Entity\ReserveTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReserveTask>
 *
 * @method ReserveTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReserveTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReserveTask[]    findAll()
 * @method ReserveTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReserveTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReserveTask::class);
    }

    public function add(ReserveTask $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReserveTask $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return ReserveTask[] Returns an array of ReserveTask objects
     */
    public function findByTag($tag): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.tag = :val')
            ->setParameter('val', $tag)
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return ReserveTask[] Returns an array of ReserveTask objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ReserveTask
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
