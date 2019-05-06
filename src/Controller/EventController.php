<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EvenementRepository;

class EventController extends AbstractController{

    private $managEvent;
    private $reposit;

    /**
     * @Route("/event", name="event")
     */
    public function event(){

        $reposit = $this->getDoctrine()->getRepository(Evenement::class);
        $listEvent = $reposit->findAll();

        return $this->render("Evenement/evenement.html.twig", [
            'listEvent' => $listEvent
        ]);
    }

    /**
     * @Route("/event/{id}", name="event.detail")
     */
    public function detail(Evenement $detailEvent){

        return $this->render("Evenement/evenementDetail.html.twig", [
            'detailEvent' => $detailEvent
        ]);
    }

    /**
     * @Route("/actu", name="actu")
     */
    public function actu(){

        $reposit = $this->getDoctrine()->getRepository(Evenement::class);
        $actualites = $reposit->eventActu();

        return $this->render("Evenement/actualite.html.twig", [
            'actualites' => $actualites
        ]);
    }
}

?>