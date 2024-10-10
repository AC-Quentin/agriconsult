<?php

namespace App\Service;

use App\Entity\User; // Assurez-vous que cette classe existe
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AsanaService
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

    public function connectAsana(User $user): bool
    {
        // Logique pour récupérer ou rafraîchir le token Asana
        if (null !== $user->getAsanaAccessToken()) {
            // Vérifiez si le token a expiré ou va expirer dans les 5 minutes
            if ($user->getAsanaTokenExpiresAt() < (new \DateTime('+5 minutes'))) {
                $refreshToken = $user->getAsanaRefreshToken();

                try {
                    // Rafraîchir le token
                    $newAccessToken = $this->clientRegistry->getClient('asana')->refreshAccessToken($refreshToken);

                    // Mettre à jour le jeton d'accès et la date d'expiration
                    $user->setAsanaAccessToken($newAccessToken->getToken());
                    $user->setAsanaTokenExpiresAt((new \DateTime())->setTimestamp($newAccessToken->getExpires()));

                    // Persister les modifications dans la base de données
                    $this->em->persist($user);
                    $this->em->flush();
                } catch (\Exception $e) {
                    // Gérer l'erreur de rafraîchissement du token
                    throw new \Exception('Erreur lors du rafraîchissement du token : '.$e->getMessage());
                }
            }
        }

        return null !== $user->getAsanaAccessToken() && null === $user->getAsanaGid();
    }

    public function getAsanaUserGid(User $user): bool
    {
        // Récupérer le token d'accès
        $accessToken = $user->getAsanaAccessToken();

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

            $data = $response->toArray();

            if (isset($data['data'])) {
                $usergid = null;

                foreach ($data['data'] as $asanaUser) {
                    $gid = $asanaUser['gid'];

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

                    $userDetails = $userDetailsResponse->toArray();

                    if (isset($userDetails['data']['email']) && $userDetails['data']['email'] === $user->getEmail()) {
                        $usergid = $gid;
                        $user->setAsanaGid($gid);
                        $this->em->persist($user);
                        $this->em->flush();

                        return true; // Indique que l'utilisateur a été trouvé
                    }
                }

                if (null === $usergid) { // Vérifiez que usergid est nul
                    return false; // Utilisateur non trouvé dans Asana
                }
            } else {
                return false; // Aucun utilisateur trouvé dans Asana
            }
        } catch (\Exception $e) {
            throw new \Exception('Erreur lors de la récupération des utilisateurs : '.$e->getMessage());
        }
    }

    public function getAsanaUserTask(string $accessToken): string
    {
        $workspaceGid = $_ENV['ASANA_WORKSPACE_GID'];

        try {
            // Requête pour obtenir les tâches de l'utilisateur
            $response = $this->httpClient->request(
                'GET',
                'https://app.asana.com/api/1.0/workspaces/'.$workspaceGid.'/tasks/search',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => sprintf('Bearer %s', $accessToken),
                    ],
                    'query' => [
                        'assignee.any' => 'me',
                        'completed' => 'false',
                    ],
                ]
            );

            $data = $response->toArray();

            if (isset($data['data'])) {
                return $data['data'];
            } else {
                return ''; // Retournez une chaîne vide si aucune donnée
            }
        } catch (\Exception $e) {
            throw new \Exception('Erreur lors de la récupération des tâches : '.$e->getMessage());
        }
    }

    /**
     * @param array<int, mixed> $taskList
     *
     * @return array<int<0, max>, mixed>
     */
    public function getAsanaTaskInProgress(string $accessToken, array $taskList): array
    {
        $taskInProgress = [];

        try {
            foreach ($taskList as $task) {
                $response = $this->httpClient->request(
                    'GET',
                    'https://app.asana.com/api/1.0/tasks/'.$task['gid'],
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => sprintf('Bearer %s', $accessToken),
                        ],
                    ]
                );

                $data = $response->toArray();

                if (isset($data['data']) && !$data['data']['completed']) {
                    $taskInProgress[] = $data['data'];
                }
            }

            return $taskInProgress;
        } catch (\Exception $e) {
            throw new \Exception('Erreur lors de la récupération des tâches : '.$e->getMessage());
        }
    }

    public function getAsanaProjectsCommerciale(string $accessToken, User $user): string
    {
        $workspaceGid = $_ENV['ASANA_WORKSPACE_GID'];
        $projectGid = '';

        try {
            // Requête pour obtenir les tâches du projet
            $response = $this->httpClient->request(
                'GET',
                'https://app.asana.com/api/1.0/users/me',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => sprintf('Bearer %s', $accessToken),
                    ],
                ]
            );

            $data = $response->toArray();

            if (isset($data['data'])) {
                $name = $data['data']['name'];

                // Séparer la chaîne par les espaces
                $firstName = explode(' ', $name);

                // Récupérer le premier mot
                $name = 'Emmanuel';
            } else {
                return ''; // Retournez une chaîne vide si aucune donnée
            }
        } catch (\Exception $e) {
            throw new \Exception('Erreur lors de la récupération des tâches : '.$e->getMessage());
        }

        try {
            // Requête pour obtenir les projets
            $response = $this->httpClient->request(
                'GET',
                'https://app.asana.com/api/1.0/projects',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => sprintf('Bearer %s', $accessToken),
                    ],
                    'query' => [
                        'opt_fields' => 'gid, name',
                    ],
                ]
            );

            $data = $response->toArray();

            if (isset($data['data'])) {
                foreach ($data['data'] as $project) {
                    if ($project['name'] == $name) {
                        $projectGid = $project['gid'];
                    }
                }
            } else {
                return ''; // Retournez une chaîne vide si aucune donnée
            }
        } catch (\Exception $e) {
            throw new \Exception('Erreur lors de la récupération des tâches : '.$e->getMessage());
        }

        try {
            // Requête pour obtenir les tâches du projet
            $response = $this->httpClient->request(
                'GET',
                'https://app.asana.com/api/1.0/workspaces/'.$workspaceGid.'/tasks/search',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => sprintf('Bearer %s', $accessToken),
                    ],
                    'query' => [
                        'projects.any' => $projectGid,
                        'completed' => 'false',
                    ],
                ]
            );

            $data = $response->toArray();

            if (isset($data['data'])) {
                return $data['data'];
            } else {
                return ''; // Retournez une chaîne vide si aucune donnée
            }
        } catch (\Exception $e) {
            throw new \Exception('Erreur lors de la récupération des tâches : '.$e->getMessage());
        }
    }
}
