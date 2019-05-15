<?php

namespace App\Controller\admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EvenementType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Classe permettant la gestion des pages concernant la gestion des événements en administrateur
 */
class AdminEventController extends AbstractController{

    //VARIABLE
    private $reposit;

    /**
     * Méthode de construction de la classe
     * @param EvenementRepository $reposit
     * @param ObjectManager $managEvent
     */
    public function __construct(EvenementRepository $reposit, ObjectManager $managEvent){
        $this->reposit = $reposit;
        $this->managEvent = $managEvent;
    }

    /**
     * Méthode permettant de créer un nouvel événement
     * @Route("/admin/create", name="admin.creation")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function creation(Request $request){

        $eventEntr = new Evenement();
        $formEvent = $this->createForm(EvenementType::class, $eventEntr);
        $formEvent->handleRequest($request);

        if($formEvent->isSubmitted() && $formEvent->isValid()){
            $this->managEvent->persist($eventEntr);
            $this->managEvent->flush();
            $this->addFlash('success', 'Événement créé.');
            return $this->redirectToRoute('admin.crud');
        }

        return $this->render("Administration/evenement/adminEvent.html.twig", [
            'formEvent' => $formEvent->createView()
        ]);
    }

    /**
     * Méthode permettant de récupérer la liste des événements
     * @Route("/admin/recupEvent", name="admin.crud")
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function recupEvent(){

        $reposit = $this->getDoctrine()->getRepository(Evenement::class);
        $eventList = $reposit->findAll();

        return $this->render("Administration/evenement/crudEvent.html.twig", [
            'current_menu' => 'gestEvenement',
            'eventList' => $eventList
        ]);
    }

    /**
     * Méthode permettant d'éditer un événement
     * @Route("/admin/{id}", name="admin.event.edit", methods="GET|POST")
     * @param Evenement $event
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function editEvent(Evenement $event, Request $request){

        $formModifEvent = $this->createForm(EvenementType::class, $event);
        $formModifEvent->handleRequest($request);

        if($formModifEvent->isSubmitted() && $formModifEvent->isValid()){
            $this->managEvent->flush();
            $this->addFlash('success', 'Événement bien modifié.');
            return $this->redirectToRoute('admin.crud');
        }

        return $this->render('Administration/evenement/editEvent.html.twig', [
            'evenement' => $event,
            'formModifEvent' => $formModifEvent->createView()
        ]);
    }

    /**
     * Méthode permettant de supprimer un événement
     * @Route("/admin/{id}", name="admin.event.suppr", methods="DELETE")
     * @param Evenement $event
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function suppression(Evenement $event, Request $request){
        if($this->isCsrfTokenValid('delete' . $event->getId(), $request->get('_token'))){
            $this->managEvent->remove($event);
            $this->managEvent->flush();
            $this->addFlash('success', 'Événement supprimé.');
        }
        
        return $this->redirectToRoute('admin.crud');
    }
}

?>