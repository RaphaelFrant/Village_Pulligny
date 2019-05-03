<?php

namespace App\Controller\admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EvenementType;

class AdminEventController extends AbstractController{

    private $managEvent;
    private $reposit;

    /**
     * @Route("/event/admin", name="evenement.event")
     */
    public function event(){

        $formEvent = $this->createForm(EvenementType::class);

        

        return $this->render("Evenement/adminEvent.html.twig", [
            'formEvent' => $formEvent->createView()
        ]);
    }

    
}

?>