<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Animal;
use App\Form\UserFormType;
use App\Form\AnimalFormType;
use App\Repository\UserRepository;
use App\Repository\AnimalRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Route('/profil')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig');
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository, TokenStorageInterface $tokenStorageInterface): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $tokenStorageInterface->setToken(null);
            $userRepository->remove($user, true);
            $this->addFlash('Succès', 'Votre compte a été supprimé');
            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }
    }

    #[Route('/user/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function userEdit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
            $this->addFlash('Succès', 'Vos informations ont été mis à jour !');
            return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profil/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/animal', name: 'app_animal_index', methods: ['GET'])]
    public function animalIndex(AnimalRepository $animalRepository): Response
    {
        $user = $this->getUser();
        return $this->render('profil/animal/index.html.twig', [
            'animals' => $animalRepository->findBy([
                'user' => $user,
            ]),
        ]);
    }

    #[Route('/animal/new', name: 'app_animal_new', methods: ['GET', 'POST'])]
    public function animalNew(Request $request, AnimalRepository $animalRepository): Response
    {
        $user = $this->getUser();
        $animal = new Animal();
        $form = $this->createForm(AnimalFormType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $animal->setUser($user);
            $animalRepository->save($animal, true);

            return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profil/animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/animal/{id}/edit', name: 'app_animal_edit', methods: ['GET', 'POST'])]
    public function animalEdit(Request $request, Animal $animal, AnimalRepository $animalRepository): Response
    {
        $form = $this->createForm(AnimalFormType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $animalRepository->save($animal, true);

            return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profil/animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/animal/{id}', name: 'app_animal_delete', methods: ['POST'])]
    public function animalDelete(Request $request, Animal $animal, AnimalRepository $animalRepository): Response
    {
            if ($this->isCsrfTokenValid('delete' . $animal->getId(), $request->request->get('_token'))) {
                $animalRepository->remove($animal, true);
            }

        return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
    }
}
