<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(RecetteRepository $recetteRepository): Response
    {
        $recettes = $recetteRepository->findBy([], ['id' => 'DESC'], 5);

        return $this->render('accueil/index.html.twig', [
            'recettes' => $recettes,
        ]);
    }
}
