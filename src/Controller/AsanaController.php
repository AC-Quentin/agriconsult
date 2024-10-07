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

    #[Route('/asana/getProjects', name: 'app_asana_getprojects')]
    public function getAsanaProjects(): Response
    {
        // Vérifier si l'utilisateur est authentifié
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login'); // Rediriger vers la page de connexion Asana
        }

        // Récupérer l'utilisateur connecté
        /** @var User $user */
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

        try {
            $response = $this->httpClient->request(
                'GET',
                'https://app.asana.com/api/1.0/projects',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => sprintf('Bearer %s', $accessToken),
                    ],
                ]
            );

            // Vérifier le contenu de la réponse
            $data = $response->toArray();

            // Vérifiez si les projets sont dans le tableau
            if (isset($data['data'])) {
                $projects = $data['data']; // Assurez-vous que la clé 'data' est celle qui contient les projets
            } else {
                // Gérer le cas où il n'y a pas de projets
                $projects = [];
            }
        } catch (\Exception $e) {
            // Log ou afficher l'erreur pour le débogage
            dump($e->getMessage());

            return $this->redirectToRoute('app_home_page', ['error' => 'Error fetching projects.']);
        }

        return $this->render('asana/projects.html.twig', [
            'projects' => $projects,
        ]);
    }

    /*#[Route('/asana/getUser', name: 'app_asana_getuser')]
    public function getAsanaUser(): Response
    {
        // Récupérer l'utilisateur connecté
        /** @var User $user
        $user = $this->getUser();

        // Récupérer le token d'accès
        $accessToken = $user->getAsanaAccessToken();

        // Vérifier si l'utilisateur a déjà un gid Asana
        if (null === $user->getAsanaGid()) {
            try {
                // Requête pour obtenir la liste des utilisateurs dans Asana
                $response = $this->httpClient->request(
                    'GET',
                    'https://app.asana.com/api/1.0/users',
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => sprintf('Bearer %s', $accessToken),
                        ],
                    ]
                );

                // Convertir la réponse en tableau
                $data = $response->toArray();

                // Vérifier si les utilisateurs sont présents dans la réponse
                if (isset($data['data'])) {
                    $usergid = null; // Variable pour stocker le gid de l'utilisateur trouvé

                    // Parcourir chaque utilisateur renvoyé par Asana
                    foreach ($data['data'] as $asanaUser) {
                        // Extraire le gid de chaque utilisateur
                        $gid = $asanaUser['gid'];

                        // Faire une nouvelle requête pour obtenir les détails de chaque utilisateur
                        $userDetailsResponse = $this->httpClient->request(
                            'GET',
                            'https://app.asana.com/api/1.0/users/'.$gid,
                            [
                                'headers' => [
                                    'Accept' => 'application/json',
                                    'Authorization' => sprintf('Bearer %s', $accessToken),
                                ],
                            ]
                        );

                        // Convertir la réponse en tableau
                        $userDetails = $userDetailsResponse->toArray();

                        // Vérifier si l'email correspond à celui de l'utilisateur connecté
                        if (isset($userDetails['data']['email']) && $userDetails['data']['email'] === $user->getEmail()) {
                            $usergid = $gid; // Stocker le gid de l'utilisateur correspondant
                            $user->setAsanaGid($gid); // Mettre à jour le gid de l'utilisateur dans la base de données
                            $this->em->persist($user); // Sauvegarder dans la base de données
                            $this->em->flush();
                            break; // Sortir de la boucle une fois l'utilisateur trouvé
                        }
                    }

                    // Si aucun utilisateur correspondant n'a été trouvé
                    if (!$usergid) {
                        // Gérer le cas où l'utilisateur n'a pas été trouvé
                        $this->addFlash('error', 'Utilisateur non trouvé dans Asana.');

                        return $this->redirectToRoute('app_home_page');
                    }
                } else {
                    // Gérer le cas où il n'y a pas d'utilisateurs dans la réponse
                    $this->addFlash('error', 'Aucun utilisateur trouvé dans Asana.');

                    return $this->redirectToRoute('app_home_page');
                }
            } catch (\Exception $e) {
                // Log ou afficher l'erreur pour le débogage
                dump($e->getMessage());

                return $this->redirectToRoute('app_home_page', ['error' => 'Erreur lors de la récupération des utilisateurs.']);
            }
        } else {
            $usergid = $user->getAsanaGid(); // Si l'utilisateur a déjà un gid
        }

        // Si l'utilisateur Asana correspondant a été trouvé ou s'il a déjà un gid
        return $this->render('asana/user.html.twig', [
            'usergid' => $usergid, // Passer le gid de l'utilisateur à la vue
        ]);
    }*/
}
