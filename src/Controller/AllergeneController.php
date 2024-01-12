<?php

namespace App\Controller;

use App\Entity\Allergene;
use App\Repository\AllergeneRepository;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllergeneController extends AbstractController
{
    #[Route('/allergene', name: 'app_allergene')]
    public function index(AllergeneRepository $allergeneRepository): Response
    {
        $Allergenes = $allergeneRepository->findBy([], ['nom' => 'ASC']);

        return $this->render('allergene/index.html.twig', [
            'Allergenes' => $Allergenes,
        ]);
    }

    #[Route('/allergene/{id}', name: 'app_allergene_show')]
    public function show(Allergene $allergene, IngredientRepository $ingredientRepository): Response
    {
        $ingredients = $ingredientRepository->etapes($allergene->getId());

        return $this->render('allergene/show.html.twig', [
            'ingredients' => $ingredients,
            'allergene' => $allergene,
        ]);
    }
}
