<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('profil/profil.html.twig');
    }

    #[Route('/mesReservations', name: 'app_mesReservations')]
    public function mesReservations(): Response
    {
        return $this->render('profil/mesReservations.html.twig');
    }
}
