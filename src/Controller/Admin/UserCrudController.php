<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
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

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setUserPassword($entityInstance);

        parent::updateEntity($entityManager, $entityInstance);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setUserPassword($entityInstance);

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function setUserPassword($entityInstance): void
    {
        $request = $this->getContext()->getRequest();
        $password = $request->get('User')['password'] ?? null;

        if (!empty($password)) {
            $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $password);
            $entityInstance->setPassword($hashedPassword);
        }
    }
}
