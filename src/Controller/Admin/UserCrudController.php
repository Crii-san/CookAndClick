<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordHasher;

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('email'),
            TextField::new('password')->onlyOnForms()
                ->setFormType(PasswordType::class)
                ->setFormTypeOptions([
                    'required' => false,
                    'empty_data' => '',
                    'attr' => [
                        'autocomplete' => 'off',
                    ],
                ]),
            TextField::new('nom'),
            TextField::new('prenom'),
            DateField::new('datenais'),
            TextField::new('pseudo'),
            TextField::new('tel'),
        ];
    }
}
