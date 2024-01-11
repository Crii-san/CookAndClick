<?php

namespace App\Form;

use App\Entity\Allergene;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
            'empty_data' => '',
                ])
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'required' => false,
                ])
            ->add('nom', TextType::class, [
                'empty_data' => '',
            ])
            ->add('prenom', TextType::class, [
                'empty_data' => '',
            ])
            ->add('dateNais')
            ->add('pseudo', TextType::class, [
                'required' => false,
                'empty_data' => '',
                    ])
            ->add('tel', TelType::class, [
                'empty_data' => '',
            ])
            ->add('allergene', EntityType::class, [
                'class' => Allergene::class,
                'choice_label' => 'nom',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('a')
                        ->orderBy('a.nom', 'ASC');
                },
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
