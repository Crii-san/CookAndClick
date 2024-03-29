<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        $utilisateurs = $userRepository->findBy([], ['nom' => 'ASC', 'prenom' => 'ASC']);

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->render('user/index.html.twig', [
                'utilisateurs' => $utilisateurs,
            ]);
        } elseif ($this->isGranted('ROLE_USER')) {
            $error_message = 'Vous n\'avez pas la permission d\'accéder à cette page.';

            return $this->render('error.html.twig', ['error_message' => $error_message]);
        } else {
            return $this->redirectToRoute('app_login');
        }
    }

    #[Route('/user/update/{id<\d+>}', name: 'app_user_update')]
    public function update(User $user, Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_login');
        }

        $currentUser = $this->getUser();
        if ($currentUser->getIdUser() !== $user->getIdUser() && !$this->isGranted('ROLE_ADMIN')) {
            $error_message = 'Vous n\'avez pas la permission de modifier cet utilisateur.';

            return $this->render('error.html.twig', ['error_message' => $error_message]);
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            if ($password) {
                $hashedPassword = $passwordHasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);
            }

            $entityManager->flush();
            $id = $user->getIdUser();

            return $this->redirectToRoute('app_user_show', parameters: ['id' => $id]);
        }

        return $this->render('user/update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/user/create', name: 'app_user_create')]
    public function create(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user, ['validation_groups' => ['create']]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            if ($password) {
                $hashedPassword = $passwordHasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->render('user/createOk.html.twig');
        }

        return $this->render('user/create.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/user/delete/{id<\d+>}', name: 'app_user_delete')]
    public function delete(User $user, Request $request, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_login');
        }

        $currentUser = $this->getUser();
        if ($currentUser->getIdUser() !== $user->getIdUser() && !$this->isGranted('ROLE_ADMIN')) {
            $error_message = 'Vous n\'avez pas la permission de supprimer cet utilisateur.';

            return $this->render('error.html.twig', ['error_message' => $error_message]);
        }

        $form = $this->createFormBuilder($user)
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->add('cancel', SubmitType::class, ['label' => 'cancel'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('delete')->isClicked()) {

                $tokenStorage->setToken(null);

                $isAdmin = in_array('ROLE_ADMIN', $user->getRoles(), true);

                $entityManager->remove($user);
                $entityManager->flush();

                if (!$isAdmin) {
                    return $this->redirectToRoute('app_accueil');
                }

            } elseif (!$form->get('delete')->isClicked()) {
                return $this->redirectToRoute('app_user_show', ['id' => $user->getIdUser()]);
            }
        }

        return $this->render('user/delete.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/user/{id}', name: 'app_user_show')]
    public function show(User $user): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_login');
        }

        $currentUser = $this->getUser();

        if ($currentUser->getIdUser() !== $user->getIdUser() && !$this->isGranted('ROLE_ADMIN')) {
            $error_message = 'Vous n\'avez pas la permission d\'accéder à cette page.';

            return $this->render('error.html.twig', ['error_message' => $error_message]);
        }

        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }
}
