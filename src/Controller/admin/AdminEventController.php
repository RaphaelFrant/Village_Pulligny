<?php

namespace App\Controller\admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EvenementType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Evenement;


class AdminEventController extends AbstractController{

    private $managEvent;
    private $reposit;

    /**
     * @Route("/event/admin", name="evenement.event")
     */
    public function event(Request $request){

        $eventEntr = new Evenement();
        $formEvent = $this->createForm(EvenementType::class, $eventEntr);
        $formEvent->handleRequest($request);

        

        return $this->render("Evenement/adminEvent.html.twig", [
            'formEvent' => $formEvent->createView()
        ]);
    }

    
}

?>