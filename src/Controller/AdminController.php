<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController{

    /**
     * @Route("/admin", name="administration")
     */
    public function administration(){
        return $this->render("Administration/administration.html.twig");
    }
}

?>