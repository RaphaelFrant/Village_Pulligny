<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe permettant de gérer l'accès à la page login
 */
class AdminController extends AbstractController{

    /**
     * Méthode renvoyant la page twig du login
     * @Route("/admin", name="administration")
     */
    public function administration(){
        return $this->render("Administration/administration.html.twig");
    }
}

?>