<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\EtapeRepository;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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

    #[IsGranted('ROLE_ADMIN')]
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

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/recette/delete/{id<\d+>}', name: 'app_recette_delete')]
    public function delete(Recette $recette, Request $request, EntityManagerInterface $entityManager, EtapeRepository $etapeRepository)
    {
        $form = $this->createFormBuilder($recette)
            ->add('delete', SubmitType::class, ['label' => 'delete'])
            ->add('cancel', SubmitType::class, ['label' => 'cancel'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->get('delete')->isClicked()) {
                $etapes = $etapeRepository->etapes($recette->getId());
                foreach ($etapes as $etape) {
                    $entityManager->remove($etape);
                }
                $entityManager->remove($recette);
                $entityManager->flush();

                return $this->redirectToRoute('app_recette');
            } elseif (!$form->get('delete')->isClicked()) {
                return $this->redirectToRoute('app_recette_show', ['id' => $recette->getId()]);
            }
        }

        return $this->render('recette/delete.html.twig', parameters: [
            'recette' => $recette,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/recette/create', name: 'app_recette_create')]
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->redirectToRoute('app_recette_createOk');
        }

        return $this->render('recette/create.html.twig', parameters: [
        'recette' => $recette,
        'form' => $form,
    ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/recette/createOk', name: 'app_recette_createOk')]
    public function createOk(): Response
    {
        return $this->render('recette/createOk.html.twig');
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/recette/{id}', name: 'app_recette_show')]
    public function show(Recette $recette): Response
    {
        return $this->render('recette/show.html.twig', [
            'recette' => $recette,
        ]);
    }
}
