<?php

namespace App\Repository;

use App\Entity\DetailRecetteIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailRecetteIngredient>
 *
 * @method DetailRecetteIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailRecetteIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailRecetteIngredient[]    findAll()
 * @method DetailRecetteIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailRecetteIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailRecetteIngredient::class);
    }

//    /**
//     * @return DetailRecetteIngredient[] Returns an array of DetailRecetteIngredient objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DetailRecetteIngredient
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
