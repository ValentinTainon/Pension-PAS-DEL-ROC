<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'sitemap')]
    public function index(): Response
    {
        $urls = [];

        $urls[] = ['loc' => $this->generateUrl('app_homepage', [], UrlGeneratorInterface::ABSOLUTE_URL)];
        $urls[] = ['loc' => $this->generateUrl('app_commentaire', [], UrlGeneratorInterface::ABSOLUTE_URL)];
        $urls[] = ['loc' => $this->generateUrl('app_galerie', [], UrlGeneratorInterface::ABSOLUTE_URL)];
        $urls[] = ['loc' => $this->generateUrl('app_formule_chien', [], UrlGeneratorInterface::ABSOLUTE_URL)];
        $urls[] = ['loc' => $this->generateUrl('app_formule_chat', [], UrlGeneratorInterface::ABSOLUTE_URL)];
        $urls[] = ['loc' => $this->generateUrl('app_education', [], UrlGeneratorInterface::ABSOLUTE_URL)];
        $urls[] = ['loc' => $this->generateUrl('app_contact', [], UrlGeneratorInterface::ABSOLUTE_URL)];
        $urls[] = ['loc' => $this->generateUrl('app_register', [], UrlGeneratorInterface::ABSOLUTE_URL)];
        $urls[] = ['loc' => $this->generateUrl('app_login', [], UrlGeneratorInterface::ABSOLUTE_URL)];
        $urls[] = ['loc' => $this->generateUrl('app_profil', [], UrlGeneratorInterface::ABSOLUTE_URL)];
        $urls[] = ['loc' => $this->generateUrl('admin', [], UrlGeneratorInterface::ABSOLUTE_URL)];

        for ($i = 0; $i < 11; $i++) {
            $urls[$i]['changefreq'] = 'weekly';
            $urls[$i]['priority'] = 1;
        }

        $response = new Response($this->renderView('/sitemap/sitemap.html.twig', ['urls' => $urls]), 200);

        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
