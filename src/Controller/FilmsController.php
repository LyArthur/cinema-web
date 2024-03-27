<?php

namespace App\Controller;

use App\API\ApiCinema;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FilmsController extends AbstractController {
    #[Route('/films', name: 'app_films', methods: ['GET'])]
    public function index(ApiCinema $apiCinema): Response {
        $films = $apiCinema->getFilmsAffiche();

        return $this->render('films/index.html.twig', [
            'films' => $films
        ]);
    }

    #[Route('/films/{id}', name: 'app_films_find', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function filmById(ApiCinema $apiCinema, int $id): Response {
        $result = $apiCinema->getFilmAndSeances($id);
        if (isset($result["code"])){
            return $this->render('_partials/_error.html.twig', [
                'error' => $result
            ]);
        }
        return $this->render('films/film.html.twig', [
            'data' => $result
        ]);
    }
}
