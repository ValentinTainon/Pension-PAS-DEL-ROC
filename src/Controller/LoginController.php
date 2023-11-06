<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last email entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/login-success', name: 'app_login_success')]
    public function onAuthenticationSuccess(): ?Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            // c'est un aministrateur : on le redirige vers l'espace admin
            return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER);
        } elseif ($this->isGranted('ROLE_USER')) {
            // c'est un client : on le redirige vers son profil
            return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
        } else {
            // sinon redirige vers l'accueil
            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }
    }
}
