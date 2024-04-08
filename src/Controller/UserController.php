<?php

namespace App\Controller;

use App\API\ApiCinema;
use App\Form\UserType;
use App\Model\UserModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController {
    #[Route('/user/register', name: 'app_user_register')]
    public function register(RequestStack $request,
                             ApiCinema    $apiCinema): Response {
        $user = new UserModel();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request->getCurrentRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $response = $apiCinema->register($data->email, $data->password, $data->confirmPassword);
            if ($response["code"] !== 201) {
                $form->addError(new FormError($response["message"]));
            } else {
                $this->addFlash("success", "Le compte a bien été enregistré");
                return $this->redirectToRoute("app_accueil");
            }
        }
        return $this->render('user/index.html.twig', [
            'form' => $form
        ]);
    }
}
