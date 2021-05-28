<?php

namespace App\Controller\Admin;

use App\Entity\Maps;
use App\Entity\WarhammerArmies;
use App\Entity\WarhammerSceneries;
use App\Entity\Buildings;
use App\Entity\MapsStatus;
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
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Campaign Map');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'), 
            MenuItem::section('Configuration', 'fas fa-wrench'),
            MenuItem::linkToCrud('Armies', 'fas fa-flag', WarhammerArmies::class), 
            MenuItem::linkToCrud('Regions', 'fas fa-mountain', WarhammerSceneries::class),
            MenuItem::linkToCrud('Buildings', 'fa fa-chess-rook', Buildings::class),
            MenuItem::section('Maps', 'fas fa-globe'),
            MenuItem::linkToCrud('Maps', 'fas fa-layer-group', Maps::class),
            MenuItem::linkToCrud('Maps Status', 'fas fa-route', MapsStatus::class)
            // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        ];
    }
}
