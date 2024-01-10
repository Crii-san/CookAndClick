<?php

namespace App\Controller\Admin;

use App\Entity\Recette;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recette::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            IntegerField::new('nivDifficulte'),
            TextField::new('description'),
            IntegerField::new('nbPersonne'),
            IntegerField::new('minutes'),
            IntegerField::new('heures'),
            AssociationField::new('categorie')
                ->setFormTypeOptions([
                    'choice_label' => 'nom',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('c')
                            ->orderBy('c.nom', 'ASC');
                    },
                ])
                ->formatValue(function ($value) {
                    return $value->getNom();
                }),
            AssociationField::new('etapes')
                ->setFormTypeOptions([
                    'choice_label' => 'numero',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('e')
                            ->orderBy('e.numero', 'ASC');
                    },
                ]),
        ];
    }
}
