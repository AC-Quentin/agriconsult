<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\DemandeCommerciale;
use App\Entity\Secheuse;
use App\Entity\User;
use App\Form\DemandeCommercialeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class DemandeCommercialeController extends AbstractController
{
    #[Route('/demande-commerciale/secheuse', name: 'app_demande_commerciale_secheuse')]
    public function secheuse(Request $request, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, MailerInterface $mailer, Pdf $knpSnappyPdf, SessionInterface $session): Response
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

            // Vérifie si les options sont définies pour affichage dans le PDF
            if (null !== $secheuseData->getVisBrassage() || null !== $secheuseData->getPrenettoyeur() || null !== $secheuseData->getB2D() || null !== $secheuseData->getDebitVis()) {
                $options = true;
            } else {
                $options = false;
            }

            // Vérifie si la vis mobile est définie pour affichage dans le PDF
            if (null !== $secheuseData->getVisMobile()) {
                $visMobile = true;
            } else {
                $visMobile = false;
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

            // Associe le client à la demande commerciale
            $demandeCommerciale->setClient($client);

            $entityManager->persist($demandeCommerciale);
            $entityManager->flush();

            // Génération du PDF
            $html = $this->renderView('pdf/demande_commerciale.html.twig', [
                'type_demande' => $type_demande,
                'demandeCommerciale' => $demandeCommerciale,
                'secheuse' => $secheuseData,
                'client' => $client,
                'clientData' => $clientData,
                'user' => $user,
                'options' => $options,
                'visMobile' => $visMobile,
            ]);

            $knpSnappyPdf->setOption('enable-javascript', true);
            $knpSnappyPdf->setOption('enable-local-file-access', true);
            $pdfContent = $knpSnappyPdf->getOutputFromHtml($html);

            $pdfName = 'demande_commerciale_'.$demandeCommerciale->getId().' - '.$clientData->getIdClient().'.pdf';

            // Stocke temporairement le PDF dans la session
            $session->set('pdf_content', $pdfContent);
            $session->set('pdf_name', $pdfName);

            // Crée le lien mailto
            $destinataire = 'x+1190066889395939@mail.asana.com';
            $sujet = $client->getIdClient().' - '.$client->getRaisonSociale();
            $corps = "Votre demande pour une {$type_demande} a bien été enregistrée.\n\n"
                ."ID Client : {$client->getIdClient()}\n"
                ."Raison Sociale : {$client->getRaisonSociale()}\n"
                ."Nom Prénom : {$clientData->getNomPrenom()}\n"
                ."Code Postal : {$clientData->getCodePostal()}\n"
                .'Délais souhaité : ';

            // Encode les paramètres pour l'URL
            $sujetEncode = rawurlencode($sujet);
            $corpsEncode = rawurlencode($corps);

            // Crée le lien mailto
            $mailtoLink = "mailto:{$destinataire}?subject={$sujetEncode}?body={$corpsEncode}";

            // Redirige vers le lien mailto

            /* Envoi de l'email
            $email = (new Email())
                ->from($userEmail)
                ->to('x+1190066889395939@mail.asana.com')
                ->subject($client->getIdClient() & " - " & $client->getRaisonSociale())
                ->text('Votre demande a bien été enregistrée.')
                ->html('<p>Votre demande pour une '.$type_demande.' a bien été enregistrée.</p><br>
                        <p>ID Client : '.$client->getIdClient().'</p><br>
                        <p>Raison Sociale : '.$client->getRaisonSociale().'</p><br>')
                ->attach($pdfContent, $pdfName, 'application/pdf');

            // Envoi de l'email
            $mailer->send($email);
            */

            // Redirige vers la page d'accueil avec l'ID en paramètre
            $url = $urlGenerator->generate('app_home_page', [
                'demandeId' => $demandeCommerciale->getId(),
                'mailto' => $mailtoLink,
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
