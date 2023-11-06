<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request)
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // $contactFormData = $form->getData();

            // $email = (new TemplatedEmail())
            // ->from(new address ($contactFormData['email'], $contactFormData['name']))
            // ->to(new Address('', 'Pension PAS DEL ROC'))
            // ->subject($contactFormData['objet'])
            // ->htmlTemplate('components/contact_email.html.twig')
            // ->context(['message' => $contactFormData['message']]);

            // $mailer->send($email);

            $this->addFlash('Succès', 'Votre message a été envoyé !');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/contact.html.twig', ['form' => $form->createView()]);
    }
}