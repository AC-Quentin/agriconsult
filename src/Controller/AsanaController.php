<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AsanaController extends AbstractController
{
    private ClientRegistry $clientRegistry;
    private HttpClientInterface $httpClient;
    private EntityManagerInterface $em;

    public function __construct(ClientRegistry $clientRegistry, HttpClientInterface $httpClient, EntityManagerInterface $em)
    {
        $this->clientRegistry = $clientRegistry;
        $this->httpClient = $httpClient;
        $this->em = $em;
    }

    #[Route('/asana/login', name: 'app_asana_login')]
    public function connectAsana(): Response
    {
        $scope[] = 'default';
        $options[] = '';

        return $this->clientRegistry->getClient('asana')->redirect($scope, $options); // Redirige vers Asana
    }

    #[Route('/asana/callback', name: 'app_asana_callback')]
    public function connectAsanaCheck(Request $request): Response
    {
        // Vérifier s'il y a des erreurs dans la requête
        if ($request->query->has('error')) {
            // Gérer les erreurs ici, par exemple rediriger l'utilisateur avec un message d'erreur
            return $this->redirectToRoute('app_home_page', [
                'error' => $request->query->get('error'),
            ]);
        }

        // Obtenir le code d'autorisation d'Asana
        $code = $request->query->get('code');

        if (!$code) {
            // Si le code n'est pas présent, redirigez avec une erreur
            return $this->redirectToRoute('app_home_page', [
                'error' => 'No authorization code provided.',
            ]);
        }

        // Appelez getAccessToken avec les options dans un tableau
        $accessToken = $this->clientRegistry->getClient('asana')->getAccessToken([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'Client Authentification' => 'Baerer',
        ]);

        // Récupérer l'utilisateur actuellement connecté
        /** @var User $user */
        $user = $this->getUser();

        // Mettre à jour l'utilisateur avec les informations du token
        $user->setAsanaAccessToken($accessToken->getToken());
        $user->setAsanaRefreshToken($accessToken->getRefreshToken());
        $user->setAsanaTokenExpiresAt((new \DateTime())->setTimestamp($accessToken->getExpires()));

        // Sauvegarder les informations dans la base de données
        $this->em->persist($user);
        $this->em->flush();

        return $this->redirectToRoute('app_home_page'); // Redirige vers la page d'accueil
    }

    #[Route('/asana/create-task', name: 'app_asana_create_task')]
    public function createAsanaTask(Request $request): Response
    {
        // Vérifier si l'utilisateur est authentifié
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login'); // Rediriger vers la page de connexion Asana
        }

        // Récupérer l'utilisateur connecté
        /** @var User $user * */
        $user = $this->getUser();

        // Vérifier si le token est expiré
        if ($user->getAsanaTokenExpiresAt() < new \DateTime()) {
            $refreshToken = $user->getAsanaRefreshToken();

            // Rafraîchir le token en appelant l'API de rafraîchissement
            $newAccessToken = $this->clientRegistry->getClient('asana')->refreshAccessToken($refreshToken);

            // Mettre à jour le jeton d'accès et la date d'expiration dans la base de données
            $user->setAsanaAccessToken($newAccessToken->getToken());
            $user->setAsanaTokenExpiresAt((new \DateTime())->setTimestamp($newAccessToken->getExpires()));
            $this->em->persist($user);
            $this->em->flush();
        }

        $accessToken = $user->getAsanaAccessToken();

        // Créer une tâche
        // Récupérer les données du formulaire (par exemple, depuis une requête POST)
        $taskData = [
            'data' => [
                'name' => 'ASANA TEST',
                'completed' => false,
                'projects' => ['1179330375474433'], // Emmanuel  =>  1190066889395939
                'workspace' => '1179330431218862',
            ],
        ];

        try {
            $response = $this->httpClient->request(
                'POST',
                'https://app.asana.com/api/1.0/tasks',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => sprintf('Bearer %s', $accessToken),
                        'Content-Type' => 'application/json',
                    ],
                    'json' => $taskData,
                ]
            );

            // Vérifier le contenu de la réponse
            $data = $response->toArray();

            // Traitement supplémentaire en fonction de la réponse
            if (isset($data['data'])) {
                // Tâche créée avec succès
                $taskId = $data['data']['id'];

                // Rediriger ou afficher un message de succès
                return $this->redirectToRoute('app_home_page', ['success' => 'Tâche créée avec succès!']);
            } else {
                return $this->redirectToRoute('app_home_page', ['error' => 'Échec de la création de la tâche.']);
            }
        } catch (\Exception $e) {
            // Log ou afficher l'erreur pour le débogage
            return $this->redirectToRoute('app_home_page', ['error' => 'Erreur lors de la création de la tâche. '.$e->getMessage()]);
        }
    }
}
