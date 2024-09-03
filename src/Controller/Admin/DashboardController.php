<?php

namespace App\Controller\Admin;

use App\Entity\BiblioBiomasse;
use App\Entity\BiblioElevateur;
use App\Entity\BiblioGrille;
use App\Entity\BiblioModule;
use App\Entity\BiblioReprise;
use App\Entity\BiblioTcFosse;
use App\Entity\BiblioTremie;
use App\Entity\BiblioVisMobile;
use App\Entity\Client;
use App\Entity\DemandeCommerciale;
use App\Entity\Manutention;
use App\Entity\Nettoyeur;
use App\Entity\Secheuse;
use App\Entity\Sechoir;
use App\Entity\Stockage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(DemandeCommercialeCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Agriconsult');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section('Dashboard'),
            MenuItem::linkToCrud('Demande Commerciale', 'fas fa-list', DemandeCommerciale::class),
            MenuItem::linkToCrud('Client', 'fas fa-user-tie', Client::class),

            MenuItem::section('Type de demande'),
            MenuItem::linkToCrud('Stockage', 'fas fa-list', Stockage::class),
            MenuItem::linkToCrud('Sécheuse', 'fas fa-list', Secheuse::class),
            MenuItem::linkToCrud('Manutention', 'fas fa-list', Manutention::class),
            MenuItem::linkToCrud('Nettoyeur', 'fas fa-list', Nettoyeur::class),
            MenuItem::linkToCrud('Séchoir', 'fas fa-list', Sechoir::class),

            MenuItem::section('Bibliothèque'),
            MenuItem::linkToCrud('Trémie', 'fas fa-list', BiblioTremie::class),
            MenuItem::linkToCrud('Grille', 'fas fa-list', BiblioGrille::class),
            MenuItem::linkToCrud('TC Fosse', 'fas fa-list', BiblioTcFosse::class),
            MenuItem::linkToCrud('Reprise', 'fas fa-list', BiblioReprise::class),
            MenuItem::linkToCrud('Elévateur', 'fas fa-list', BiblioElevateur::class),
            MenuItem::linkToCrud('Module', 'fas fa-list', BiblioModule::class),
            MenuItem::linkToCrud('Biomasse', 'fas fa-list', BiblioBiomasse::class),
            MenuItem::linkToCrud('Vis Mobile', 'fas fa-list', BiblioVisMobile::class),
        ];
    }
}
