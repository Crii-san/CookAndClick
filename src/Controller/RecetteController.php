<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    #[Route('/recette', name: 'app_recette')]
    public function index(RecetteRepository $recetteRepository): Response
    {
        $recettes = $recetteRepository->findBy([], ['nom' => 'ASC']);

        return $this->render('recette/index.html.twig', [
            'recettes' => $recettes,
        ]);
    }

    #[Route('/recette/entree', name: 'app_entree')]
    public function entree(RecetteRepository $recetteRepository): Response
    {
        $recettes = $recetteRepository->findEntree();

        return $this->render('recette/entree.html.twig', [
            'recettes' => $recettes,
        ]);
    }
}
