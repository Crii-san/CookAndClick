<?php

namespace App\Controller;

use App\Entity\Etape;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Form\EtapeType;
use App\Form\IngredientListType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EtapeController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/etape/create/{id<\d+>}', name: 'app_etape_create')]
    public function create(Recette $recette, Request $request, EntityManagerInterface $entityManager)
    {
        $etape = new Etape();

        $ingredient = new Ingredient();
        $etape->addIngredient($ingredient);

        $form = $this->createForm(EtapeType::class, $etape);
        $form2 = $this->createForm(IngredientListType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ingredient);
            $entityManager->persist($etape);
            $entityManager->flush();

            return $this->redirectToRoute('app_ingredient_add', parameters: ['id' => $recette->getId(), 'id2' => $etape->getId()]);
        }

        return $this->render('etape/create.html.twig', parameters: [
            'etape' => $etape,
            'form' => $form,
            'recette' => $recette,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/etape/createOk/{id<\d+>}', name: 'app_etape_createOk')]
    public function createOk(Recette $recette): Response
    {
        return $this->render('etape/createOk.html.twig', parameters: [
        'recette' => $recette,
    ]);
    }
}
