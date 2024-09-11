<?php

namespace App\Controller;

use App\Entity\DemandeCommerciale;
use App\Entity\Secheuse;
use App\Form\DemandeCommercialeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DemandeCommercialeController extends AbstractController
{
    #[Route('/demande-commerciale', name: 'app_demande_commerciale')]
    public function index(Request $request, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator): Response
    {
        $demandeCommerciale = new DemandeCommerciale();
        $form = $this->createForm(DemandeCommercialeFormType::class, $demandeCommerciale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $secheuseData = $form->get('secheuse')->getData(); // Récupère les données de Secheuse

            if ($secheuseData) {
                // Critères de comparaison pour Secheuse
                $criteria = [
                    'TYPE_SECHEUSE' => $secheuseData->getTypeSecheuse(),
                    'TYPE_PLANCHER' => $secheuseData->getTypePlancher(),
                    'TYPE_REPRISE' => $secheuseData->getTypeReprise(),
                    'DEBIT_REPRISE' => $secheuseData->getDebitReprise(),
                    'TYPE_MODULE' => $secheuseData->getTypeModule(),
                    'GAZ' => $secheuseData->getGaz(),
                    'TYPE_BIOMASSE' => $secheuseData->getTypeBiomasse(),
                    'VIS_BRASSAGE' => $secheuseData->getVisBrassage(),
                    'QUANTITE' => $secheuseData->getQuantite(),
                    'PRENETTOYEUR' => $secheuseData->getPrenettoyeur(),
                    'B2D' => $secheuseData->getB2D(),
                    'DEBIT_VIS' => $secheuseData->getDebitVis(),
                    'VIS_MOBILE' => $secheuseData->getVisMobile(),
                ];

                // Cherche une Secheuse existante correspondant aux critères
                $existingSecheuse = $entityManager->getRepository(Secheuse::class)->findOneBy($criteria);

                if ($existingSecheuse) {
                    // Utiliser l'ID de la Secheuse existante
                    $entityManager->persist($existingSecheuse);
                    $entityManager->flush();
                    $demandeCommerciale->setSecheuse($existingSecheuse);
                } else {
                    // Créer une nouvelle Secheuse
                    $newSecheuse = new Secheuse();
                    $newSecheuse->setTypeSecheuse($secheuseData->getTypeSecheuse());
                    $newSecheuse->setTypePlancher($secheuseData->getTypePlancher());
                    $newSecheuse->setTypeReprise($secheuseData->getTypeReprise());
                    $newSecheuse->setDebitReprise($secheuseData->getDebitReprise());
                    $newSecheuse->setTypeModule($secheuseData->getTypeModule());
                    $newSecheuse->setGaz($secheuseData->getGaz());
                    $newSecheuse->setBiomasse($secheuseData->getBiomasse());
                    $newSecheuse->setVisBrassage($secheuseData->getVisBrassage());
                    $newSecheuse->setQuantite($secheuseData->getQuantite());
                    $newSecheuse->setPrenettoyeur($secheuseData->getPrenettoyeur());
                    $newSecheuse->setB2D($secheuseData->getB2D());
                    $newSecheuse->setDebitVis($secheuseData->getDebitVis());
                    $newSecheuse->setVisMobile($secheuseData->getVisMobile());

                    // Associe la nouvelle Secheuse à la demande commerciale
                    $entityManager->persist($newSecheuse);
                    $entityManager->flush();
                    $demandeCommerciale->setSecheuse($newSecheuse);
                }
            }

            $entityManager->persist($demandeCommerciale);
            $entityManager->flush();

            // Redirige vers la page d'accueil avec l'ID en paramètre
            $url = $urlGenerator->generate('app_home_page', [
                'demandeId' => $demandeCommerciale->getId(),
            ]);

            return new RedirectResponse($url);
        }

        return $this->render('demande_commerciale/index.html.twig', [
            'demandeCommercialeForm' => $form->createView(),
        ]);
    }
}
