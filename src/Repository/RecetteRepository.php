<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 *
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

//    /**
//     * @return Recette[] Returns an array of Recette objects
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

    public function findEntree(): array
    {
        $qb = $this->createQueryBuilder('recette');
        $qb->select('recette')
            ->addSelect('categorie')
            ->join('recette.categorie', 'categorie')
            ->where('categorie = 1');

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function findPlat(): array
    {
        $qb = $this->createQueryBuilder('recette');
        $qb->select('recette')
            ->addSelect('categorie')
            ->join('recette.categorie', 'categorie')
            ->where('categorie = 2');

        $query = $qb->getQuery();

        return $query->execute();
    }

}
