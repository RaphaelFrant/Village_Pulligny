<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Classe permettant de gérer la page d'authentification 
 */
class SecurityController extends AbstractController{

    //VARIABLE
    private $managEvent;
    private $reposit;

    /**
     * Méthode permettant d'afficher la page d'authentification
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authentificationUtils
     * @return Symfony\Component\HttpFoundation\Response; Renvoie un user ou un message d'erreur
     */
    public function login(AuthenticationUtils $authentificationUtils){

        $user = $authentificationUtils->getLastUsername();
        $error = $authentificationUtils->getLastAuthenticationError();

        return $this->render("Administration/login.html.twig", [
            'user' => $user,
            'error' => $error
        ]);
    }

}

?>