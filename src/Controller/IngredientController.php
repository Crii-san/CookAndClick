<?php

namespace App\Controller;

use App\Entity\Etape;
use App\Entity\Recette;
use App\Form\IngredientListType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(): Response
    {
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/etape/add/{id<\d+>}/{id<\d+>}', name: 'app_ingredient_add')]
    public function add(Recette $recette, Etape $etape, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(IngredientListType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $etape->addIngredient($ingredient);
            $entityManager->flush();

            return $this->redirectToRoute('app_etape_create', parameters: ['id' => $recette->getId()]);
        }

        return $this->render('recette/create.html.twig', parameters: [
            'recette' => $recette,
            'form' => $form,
        ]);
    }
}
