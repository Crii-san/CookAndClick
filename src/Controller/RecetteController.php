<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
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



    #[Route('/recette/update/{id<\d+>}', name: 'app_recette_update')]
    public function update(Recette $recette, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecetteType::class, $recette);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $id = $recette->getId();

            return $this->redirectToRoute('app_recette_show', parameters: [
                'id' => $id,
            ]);
        }

        return $this->render('recette/update.html.twig', parameters: [
            'recette' => $recette,
            'form' => $form,
        ]);
    }

    #[Route('/recette/delete/{id<\d+>}', name: 'app_recette_delete')]
    public function delete(Recette $recette)
    {
        return $this->render('recette/delete.html.twig', parameters: [
            'recette' => $recette,
        ]);
    }

    #[Route('/recette/create', name: 'app_recette_create')]
    public function create( Request $request, EntityManagerInterface $entityManager)
    {
        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $id = $recette->getId();

            return $this->redirectToRoute('app_recette_show', parameters: [
                'id' => $id,
            ]);
        }

        return $this->render('recette/create.html.twig', parameters: [
        'recette' => $recette,
        'form' => $form,
    ]);
    }

    #[Route('/recette/{id}', name: 'app_recette_show')]
    public function show(Recette $recette): Response
    {
        return $this->render('recette/show.html.twig', [
            'recette' => $recette,
        ]);
    }
}
