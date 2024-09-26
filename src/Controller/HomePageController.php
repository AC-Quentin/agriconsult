<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(): Response
    {
        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

    #[Route('/telecharger-pdf', name: 'telecharger_pdf')]
    public function telechargerPdf(SessionInterface $session): Response
    {
        // Récupère le contenu et le nom du PDF depuis la session
        $pdfContent = $session->get('pdf_content');
        $pdfName = $session->get('pdf_name');

        // Si le PDF n'existe pas, renvoyer une erreur ou rediriger
        if (!$pdfContent || !$pdfName) {
            return $this->redirectToRoute('app_home_page');
        }

        // Crée la réponse avec le PDF
        $response = new Response($pdfContent);
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $pdfName
        ));

        return $response;
    }
}
