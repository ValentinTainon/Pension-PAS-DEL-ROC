<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireFormType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use App\Repository\GalerieRepository;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        $commentaires = $commentaireRepository->findBy(['isValidated' => true], ['dateCreation' => 'DESC']);

        return $this->render('main/homepage.html.twig', ['commentaires' => $commentaires]);
    }
    
    #[Route('/commentaire', name: 'app_commentaire_form', methods: ['GET', 'POST'])]
    public function commentaireForm(Request $request, CommentaireRepository $commentaireRepository): Response
    {
        $commentaire = new Commentaire();

        $form = $this->createForm(CommentaireFormType::class, $commentaire);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // $dateCreation = (new \DateTime('now'));
            // $autheur = $form->get('autheur')->getData();
            // $emailAutheur = $form->get('email')->getData();
            // $message = $form->get('message')->getData();

            // $commentaire->setDateCreation($dateCreation)
            //             ->setAutheur($autheur)
            //             ->setEmail($emailAutheur)
            //             ->setMessage($message);

            // $commentaireRepository->save($commentaire, true);

            /* Envoi d'un email d'information à PAS DEL ROC  */
            // $email = (new Email())
            // ->from(new Address($emailAutheur, $autheur))
            // ->to(new Address('', 'PAS DEL ROC'))
            // ->subject('Pension PAS DEL ROC - ' . $autheur . ' vous a laissé un commentaire')
            // ->text($autheur . ' vous a laissé le commentaire suivant: ' . $message);
            
            // $mailer->send($email);

            $this->addFlash('Succès', 'Votre commentaire a été envoyé pour validation');

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre_d_or/_form.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

    #[Route('/galerie', name: 'app_galerie')]
    public function galerie(GalerieRepository $galerieRepository): Response
    {
        $images = $galerieRepository->findBy([], ['updatedAt' => 'DESC']);

        return $this->render('galerie/index.html.twig', ['images' => $images]);
    }
    
    #[Route('/formule-chien', name: 'app_formule_chien')]
    public function formuleChien(): Response
    {
        return $this->render('formules/chien.html.twig');
    }
    
    #[Route('/formule-chat', name: 'app_formule_chat')]
    public function formuleChat(): Response
    {
        return $this->render('formules/chat.html.twig');
    }
    
    #[Route('/education', name: 'app_education')]
    public function education(): Response
    {
        return $this->render('education/education.html.twig');
    }
    
    #[Route('/livre-d-or', name: 'app_livre_d_or')]
    public function livreDor(CommentaireRepository $commentaireRepository): Response
    {
        $commentaires = $commentaireRepository->findBy(['isValidated' => true], ['dateCreation' => 'DESC']);

        return $this->render('livre_d_or/livre_d_or.html.twig', ['commentaires' => $commentaires]);
    }
}
