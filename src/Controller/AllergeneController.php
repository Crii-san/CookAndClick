<?php

namespace App\Controller;

use App\Repository\AllergeneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllergeneController extends AbstractController
{
    #[Route('/allergene', name: 'app_allergene')]
    public function index(AllergeneRepository $allergeneRepository): Response
    {
        $Allergenes = $allergeneRepository->findBy([],['nom'=>'ASC']);

        return $this->render('allergene/index.html.twig', [
            'Allergenes' => $Allergenes,
        ]);
    }
}
