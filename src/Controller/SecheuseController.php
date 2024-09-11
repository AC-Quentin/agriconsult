<?php

namespace App\Controller;

use App\Entity\Secheuse;
use App\Form\SecheuseFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SecheuseController extends AbstractController
{
    #[Route('/secheuse', name: 'app_secheuse')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $secheuse = new Secheuse();
        $form = $this->createForm(SecheuseFormType::class, $secheuse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($secheuse);
            $entityManager->flush();

            // You can add a flash message or redirect if needed
            return $this->redirectToRoute('/homepage');
        }

        return $this->render('secheuse/index.html.twig', [
            'secheuseForm' => $form,
        ]);
    }
}
