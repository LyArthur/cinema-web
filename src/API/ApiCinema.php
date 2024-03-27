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
            "http://172.16.216.1:8000/api/films",

        );
        return $rep->toArray();
    }

    public function getFilmAndSeances(int $id) {
        $rep = $this->client->request(
            'GET',
            "http://172.16.216.1:8000/api/films/{$id}",
        );
        return $rep->toArray();
    }
}