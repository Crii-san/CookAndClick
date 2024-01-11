<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        $utilisateurs = $userRepository->findBy([], ['nom' => 'ASC', 'prenom' => 'ASC']);

        if (!$this->isGranted('ROLE_ADMIN')) {
            $error_message = 'Vous n\'avez pas la permission d\'accéder à cette page.';
            return $this->render('error.html.twig', ['error_message' => $error_message]);
        }

        return $this->render('user/index.html.twig', [
        'utilisateurs' => $utilisateurs,
        ]);
    }

    #[Route('/user/{id}', name: 'app_user_show')]
    public function show(User $user): Response
    {
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
