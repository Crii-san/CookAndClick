<?php

namespace App\Controller;

use App\Entity\Etape;
use App\Entity\Recette;
use App\Form\IngredientListType;
use App\Repository\IngredientRepository;
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
    #[Route('/ingredient/add/{id<\d+>}/{id2<\d+>}', name: 'app_ingredient_add')]
    public function add(Recette $recette, Etape $etape, Request $request, EntityManagerInterface $entityManager, IngredientRepository $ingredientRepository)
    {
        $form = $this->createForm(IngredientListType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredientList =$_POST["ingredient_list"]["ingredient"];
            $ingredients = $ingredientRepository->search($ingredientList);
            foreach ($ingredients as $ingredient)
            $etape->addIngredient($ingredients);
            $entityManager->flush();

            return $this->redirectToRoute('app_etape_createOk', parameters: ['id' => $recette->getId()]);
        }

        return $this->render('ingredient/add.html.twig', parameters: [
            'recette' => $recette,
            'form' => $form,
            'etape' => $etape,
        ]);
    }
}
