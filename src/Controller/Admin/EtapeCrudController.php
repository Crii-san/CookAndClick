<?php

namespace App\Controller\Admin;

use App\Entity\Etape;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EtapeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Etape::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('numero'),
            TextField::new('description'),
            AssociationField::new('ingredients')
                ->setFormTypeOptions([
                    'choice_label' => 'nom',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('r')
                            ->orderBy('r.nom', 'ASC');
                    },
                ]),
            AssociationField::new('recette')
                ->setFormTypeOptions([
                    'choice_label' => 'nom',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('r')
                            ->orderBy('r.nom', 'ASC');
                    },
                ])
                ->formatValue(function ($value) {
                    return $value?->getNom();
                }),
        ];
    }

}
