<?php

namespace App\API;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiCinema {
    private HttpClientInterface $client;

    /**
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client) {
        $this->client = $client;
    }

    public function getFilmsAffiche(): array {
        $rep = $this->client->request(
            'GET',
            $_ENV['API_CINEMA'] . "api/films",

        );
        return $rep->toArray();
    }

    public function getFilmAndSeances(int $id): array {
        $rep = $this->client->request(
            'GET',
            $_ENV['API_CINEMA'] . "api/films/{$id}",
        );
        return $rep->toArray();
    }

    public function register(string $email, string $password, string $confirmPassword): array|string {
        try {
            $rep = $this->client->request(
                'POST',
                $_ENV['API_CINEMA'] . "api/users/register", [
                    'json' => ["email" => $email, "password" => $password, "confirmPassword" => $confirmPassword],
                ]
            );
            return $rep->toArray();
        } catch (\Exception $e) {
            $error = json_decode($rep->getContent(false));
            return ["code" => $error->code, "message" => $error->message];
        }
    }
}