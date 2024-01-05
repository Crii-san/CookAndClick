<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    #[Route('/recette', name: 'app_recette')]
    public function index(RecetteRepository $recetteRepository, Request $request): Response
    {
        $searchText = $request->query->get('search', '');
        $recettes = $recetteRepository->search($searchText);

        return $this->render('recette/index.html.twig', [
            'recettes' => $recettes, 'search' => $searchText,
        ]);
    }
}
