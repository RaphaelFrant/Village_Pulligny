<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController{

    private $managEvent;
    private $reposit;

    /**
     * @Route("/login", name="login")
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