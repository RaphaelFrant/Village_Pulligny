<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController{

    private $managEvent;
    private $reposit;

    /**
     * @Route("/event", name="event")
     */
    public function event(){
        return $this->render("Evenement/evenement.html.twig");
    }

    /**
     * @Route("/actu", name="actu")
     */
    public function actu(){
        return $this->render("Evenement/actualite.html.twig");
    }
}

?>