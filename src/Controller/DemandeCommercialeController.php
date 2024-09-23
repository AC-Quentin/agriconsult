<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\DemandeCommerciale;
use App\Entity\Secheuse;
use App\Entity\User;
use App\Form\DemandeCommercialeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class DemandeCommercialeController extends AbstractController
{
    #[Route('/demande-commerciale/secheuse', name: 'app_demande_commerciale_secheuse')]
    public function secheuse(Request $request, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, MailerInterface $mailer): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Vérifiez si l'utilisateur est authentifié
        if (!$user instanceof UserInterface) {
            throw new AccessDeniedException('Vous devez être connecté pour faire une demande.');
        }

        // Si l'utilisateur est une instance de votre entité User, récupère son email
        if ($user instanceof User) {
            $userEmail = $user->getEmail();
        } else {
            throw new AccessDeniedException('Impossible de récupérer l\'email de l\'utilisateur.');
        }

        $type_demande = 'secheuse';
        $demandeCommerciale = new DemandeCommerciale();

        // Ajout de la date de la demande
        $demandeCommerciale->setDate(new \DateTimeImmutable());
        // Ajout du type de demande
        $demandeCommerciale->setTypeDemande($type_demande);

        $form = $this->createForm(DemandeCommercialeFormType::class, $demandeCommerciale, [
            'type_demande' => $type_demande,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $secheuseData = $form->get('secheuse')->getData(); // Récupère les données de Secheuse

            if ($secheuseData) {
                // Critères de comparaison pour Secheuse
                $criteria = [
                    'type_secheuse' => $secheuseData->getTypeSecheuse(),
                    'type_plancher' => $secheuseData->getTypePlancher(),
                    'type_reprise' => $secheuseData->getTypeReprise(),
                    'debit_reprise' => $secheuseData->getDebitReprise(),
                    'type_module' => $secheuseData->getTypeModule(),
                    'gaz' => $secheuseData->getGaz(),
                    'biomasse' => $secheuseData->getBiomasse(),
                    'vis_brassage' => $secheuseData->getVisBrassage(),
                    'quantite' => $secheuseData->getQuantite(),
                    'prenettoyeur' => $secheuseData->getPrenettoyeur(),
                    'b2d' => $secheuseData->getB2D(),
                    'debit_vis' => $secheuseData->getDebitVis(),
                    'vis_mobile' => $secheuseData->getVisMobile(),
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

            $clientData = $form->get('client')->getData();
            $client = $entityManager->getRepository(Client::class)->findOneBy(['id_client' => $clientData->getIdClient()]);

            if (!$client) {
                // Si le client n'existe pas, créer un nouveau client
                $client = new Client();
                $client->setIdClient($clientData->getIdClient());
                $client->setRaisonSociale($clientData->getRaisonSociale());
                // Définir d'autres propriétés du client si nécessaire
                $entityManager->persist($client);
            }

            // Envoi de l'email
            $email = (new Email())
                ->from($userEmail)
                ->to('client-email@example.com')
                ->subject($client->getIdClient())
                ->text('Votre demande a bien été enregistrée.')
                ->html('<p>Votre demande pour une '.$type_demande.' a bien été enregistrée.</p><br>
                        <p>ID Client : '.$client->getIdClient().'</p><br>
                        <p>Raison Sociale : '.$client->getRaisonSociale().'</p><br>');
            // Envoi de l'email
            $mailer->send($email);

            // Associe le client à la demande commerciale
            $demandeCommerciale->setClient($client);

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
            'type_demande' => $type_demande,
        ]);
    }

    #[Route('/demande-commerciale/stockage', name: 'app_demande_commerciale_stockage')]
    public function stockage(Request $request, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator): Response
    {
        $type_demande = 'stockage';
        $demandeCommerciale = new DemandeCommerciale();

        // Ajout de la date de la demande
        $demandeCommerciale->setDate(new \DateTimeImmutable());
        // Ajout du type de demande
        $demandeCommerciale->setTypeDemande($type_demande);

        $form = $this->createForm(DemandeCommercialeFormType::class, $demandeCommerciale, [
            'type_demande' => $type_demande,
        ]);
        $form->handleRequest($request);

        return $this->render('demande_commerciale/index.html.twig', [
            'demandeCommercialeForm' => $form->createView(),
            'type_demande' => $type_demande,
        ]);
    }
}
