<?php

namespace App\Repository;

use App\Entity\EvaluationSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EvaluationSkill>
 *
 * @method EvaluationSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method EvaluationSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method EvaluationSkill[]    findAll()
 * @method EvaluationSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvaluationSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EvaluationSkill::class);
    }

    public function save(EvaluationSkill $entity, bool $flush = false): EvaluationSkill
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $entity;
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    public function remove(EvaluationSkill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EvaluationSkill[] Returns an array of EvaluationSkill objects
//     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('es')
    //            ->andWhere('es.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EvaluationSkill
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}