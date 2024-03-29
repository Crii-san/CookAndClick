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

    /**
     * @return Recette[] Returns an array of Recette objects
     */
    public function search(string $text = ''): array
    {
        $qb = $this->createQueryBuilder('recette');
        $qb->select('recette')
            ->addSelect('categorie')
            ->leftJoin('recette.categorie', 'categorie')
            ->where($qb->expr()->orX(
                $qb->expr()->like('recette.nom', ':text'),
            ))
            ->setParameter('text', '%'.$text.'%')
            ->orderBy('recette.nom', 'ASC');

        $query = $qb->getQuery();

        return $query->execute();
    }
}
