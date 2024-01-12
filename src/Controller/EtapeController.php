<?php

namespace App\Controller;

use App\Entity\Etape;
use App\Form\EtapeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EtapeController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/etape/create', name: 'app_etape_create')]
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $etape = new Etape();
        $form = $this->createForm(EtapeType::class, $etape);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etape);
            $entityManager->flush();

            return $this->redirectToRoute('app_etape_createOk');
        }

        return $this->render('etape/create.html.twig', parameters: [
            'etape' => $etape,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/etape/createOk', name: 'app_etape_createOk')]
    public function createOk(): Response
    {
        return $this->render('etape/createOk.html.twig');
    }
}
