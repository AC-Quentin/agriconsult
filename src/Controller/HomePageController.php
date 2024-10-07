<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\AsanaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends AbstractController
{
    private AsanaService $asanaService;

    public function __construct(AsanaService $asanaService)
    {
        $this->asanaService = $asanaService;
    }

    #[Route('/', name: 'app_home_page')]
    public function index(SessionInterface $sessionAsana): Response
    {
        // Vérifiez si l'utilisateur est connecté
        /** @var User $user */
        $user = $this->getUser();

        if ($user instanceof User) {
            // Utiliser le service pour gérer la connexion à Asana
            if ($accessToken = $user->getAsanaAccessToken()) {
            }

            if (!$accessToken) {
                return $this->redirectToRoute('app_asana_login');
            } else {
                if (null == $user->getAsanaGid()) {
                    $userGid = $this->asanaService->getAsanaUserGid($user);
                }
                // Vérifiez si les tâches en cours sont déjà stockées dans la session
                $taskInProgress = $sessionAsana->get('task_in_progress');

                if (null === $taskInProgress) {
                    // Les tâches ne sont pas en session, récupérez-les depuis Asana
                    $get_user_task_list_gid = $this->asanaService->getAsanaUserTask($user->getAsanaAccessToken(), $user->getAsanaGid());
                    $task_from_user_list = $this->asanaService->getAsanaTaskFromUserList($user->getAsanaAccessToken(), $get_user_task_list_gid);
                    $taskInProgress = $this->asanaService->getAsanaTaskInProgress($user->getAsanaAccessToken(), $task_from_user_list);

                    // Stockez les tâches en session pour une utilisation future
                    $sessionAsana->set('task_in_progress', $taskInProgress);
                }
            }
        }

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'task_in_progress' => $taskInProgress,
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
