<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('profil/profil.html.twig');
    }

    #[Route('/mesReservations', name: 'app_mesReservations')]
    #[IsGranted('ROLE_USER')]
    public function mesReservations(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();

        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('profil/mesReservations.html.twig', [
                'reservations' => $reservationRepository->findAll(),
            ]);
        }
        return $this->render('profil/mesReservations.html.twig', [
            'reservations' => $reservationRepository->findBy([
                'user' => $user,
            ])
        ]);
    }

    #[Route('/avisClient', name: 'app_avisClient', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function avisClient(Request $request, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AvisClientType::class, ['user' => $user]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
            $this->addFlash('Succès', 'Votre commentaire a été envoyé !');
            return $this->redirectToRoute('app_mesReservations', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil/avisClient.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
