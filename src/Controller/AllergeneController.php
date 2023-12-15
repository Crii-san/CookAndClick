<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllergeneController extends AbstractController
{
    #[Route('/allergene', name: 'app_allergene')]
    public function index(): Response
    {
        return $this->render('allergene/index.html.twig', [
            'controller_name' => 'AllergeneController',
        ]);
    }
}
