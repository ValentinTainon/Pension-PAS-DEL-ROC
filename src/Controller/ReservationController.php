<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Animal;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\AnimalRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/reservation')]
class ReservationController extends AbstractController
{
    #[Route('/', name: 'app_reservation_index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }
    
    #[Route('/new', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository, AnimalRepository $animalRepository, ReservationRepository $reservationRepository, SluggerInterface $slugger): Response
    {
        $author = $this->getUser(); // Récupère et stocke l'utilisateur connecté.

        if (!$author) {
            return $this->redirectToRoute('app_main');
            $this->addFlash('Erreur', 'Vous devez avoir un compte et vous connecter pour réserver !');
        } 

        $user = new User();
        $animal = new Animal();
        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, ['user' => $user, 'animal' => $animal, 'reservation' => $reservation]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $ordonnanceFile = $form['animal']->get('ordonnanceFile')->getData();      
            
            if ($ordonnanceFile) {
                $originalFilename = pathinfo($ordonnanceFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $ordonnanceFile->guessExtension();
                try {
                    $ordonnanceFile->move(
                        $this->getParameter('documents_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $animal->setOrdonnanceFile($newFilename);
            }

            $userRepository->save($user, true);
            $animal->setIdUser($author);
            $animalRepository->save($animal, true);
            $reservation->setIdUser($author);
            $reservation->setIdAnimal($animal);
            $reservationRepository->save($reservation, true);

            $this->addFlash('Succès', 'Votre réservation à bien été envoyé !');

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }
     
        return $this->renderForm('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, ReservationRepository $reservationRepository): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationRepository->save($reservation, true);

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, ReservationRepository $reservationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $reservationRepository->remove($reservation, true);
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
