<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Galerie;
use App\Entity\Commentaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        
        $url = $routeBuilder->setController(AdminProfileCrudController::class)->generateUrl();
        
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()->setTitle('Pas Del Roc')->setFaviconPath('/images/favicon.png');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)->setName($user->getPrenom());
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Mon profil', 'fas fa-user', User::class)->setController(AdminProfileCrudController::class);
        yield MenuItem::linkToCrud('Clients', 'fas fa-users', User::class)->setController(CustomerCrudController::class);
        yield MenuItem::linkToCrud('Galerie', 'fas fa-images', Galerie::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comments', Commentaire::class);
        yield MenuItem::linktoRoute('Retour sur le site', 'fas fa-home', 'app_homepage');
    }
}
