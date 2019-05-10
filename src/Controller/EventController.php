<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EvenementRepository;

/**
 * Classe controller des événements
 */
class EventController extends AbstractController{

    //VARIABLE
    private $managEvent;
    private $reposit;

    /**
     * Méthode permettant d'affichr l'ensemble des événements de la base de données dans la page "Evenement"
     * @Route("/event", name="event")
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function event(){

        $reposit = $this->getDoctrine()->getRepository(Evenement::class);
        $listEvent = $reposit->findAll();

        return $this->render("Evenement/evenement.html.twig", [
            'listEvent' => $listEvent
        ]);
    }

    /**
     * Méthode permettant d'avoir les détails sur un événement précis
     * @Route("/event/{id}", name="event.detail")
     * @param Evenement $detailEvent
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function detail(Evenement $detailEvent){

        return $this->render("Evenement/evenementDetail.html.twig", [
            'detailEvent' => $detailEvent
        ]);
    }

    /**
     * Méthode permettant de n'afficher que les événements qui n'ont pas encore eu lieu sur la page "Actualité"
     * @Route("/actu", name="actu")
     * @return Symfony\Component\HttpFoundation\Response;
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