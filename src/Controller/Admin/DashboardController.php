<?php

namespace App\Controller\Admin;

use App\Entity\Allergene;
use App\Entity\Categorie;
use App\Entity\Etape;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cook & Click Admin');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToCrud('Allergènes', 'fas fa-list', Allergene::class),
            MenuItem::linkToCrud('Ingredients', 'fas fa-list', Ingredient::class),
            MenuItem::linkToCrud('Catégories', 'fas fa-list', Categorie::class),
            MenuItem::linkToCrud('Recette', 'fas fa-list', Recette::class),
            MenuItem::linkToCrud('User', 'fas fa-list', User::class),
            MenuItem::linkToCrud('Etape', 'fas fa-list', Etape::class),
        ];
    }
}
