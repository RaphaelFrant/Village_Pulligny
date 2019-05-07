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


class AdminEventController extends AbstractController{

    
    private $reposit;

    public function __construct(EvenementRepository $reposit, ObjectManager $managEvent){
        $this->reposit = $reposit;
        $this->managEvent = $managEvent;
    }

    /**
     * 
     * @Route("/admin/create", name="admin.creation")
     */
    public function creation(Request $request){

        $eventEntr = new Evenement();
        $formEvent = $this->createForm(EvenementType::class, $eventEntr);
        $formEvent->handleRequest($request);

        if($formEvent->isSubmitted() && $formEvent->isValid()){
            $this->managEvent->persist($eventEntr);
            $this->managEvent->flush();
            return $this->redirectToRoute('admin.crud');
        }

        return $this->render("Administration/evenement/adminEvent.html.twig", [
            'formEvent' => $formEvent->createView()
        ]);
    }

    /**
     * @Route("/admin/recupEvent", name="admin.crud")
     */
    public function recupEvent(){

        $reposit = $this->getDoctrine()->getRepository(Evenement::class);
        $eventList = $reposit->findAll();

        return $this->render("Administration/evenement/crudEvent.html.twig", [
            'eventList' => $eventList
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.event.edit", methods="GET|POST")
     */
    public function editEvent(Evenement $event, Request $request){

        $formModifEvent = $this->createForm(EvenementType::class, $event);
        $formModifEvent->handleRequest($request);

        if($formModifEvent->isSubmitted() && $formModifEvent->isValid()){
            $this->managEvent->flush();
            return $this->redirectToRoute('admin.crud');
        }

        return $this->render('Administration/evenement/editEvent.html.twig', [
            'evenement' => $event,
            'formModifEvent' => $formModifEvent->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.event.suppr", methods="DELETE")
     */
    public function suppression(Evenement $event, Request $request){
        if($this->isCsrfTokenValid('delete' . $event->getId(), $request->get('_token'))){
            $this->managEvent->remove($event);
            $this->managEvent->flush();
        }
        
        return $this->redirectToRoute('admin.crud');
    }
}

?>