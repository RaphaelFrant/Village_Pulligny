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

        return $this->render("Evenement/adminEvent.html.twig", [
            'formEvent' => $formEvent->createView()
        ]);
    }

    /**
     * @Route("/admin/recupEvent", name="admin.crud")
     */
    public function recupEvent(){

        $reposit = $this->getDoctrine()->getRepository(Evenement::class);
        $eventList = $reposit->findAll();

        return $this->render("Evenement/crudEvent.html.twig", [
            'eventList' => $eventList
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.event.edit")
     */
    public function editEvent(Evenement $event, Request $request){

        $formModifEvent = $this->createForm(EvenementType::class, $event);
        $formModifEvent->handleRequest($request);

        if($formModifEvent->isSubmitted() && $formModifEvent->isValid()){
            $this->managEvent->flush();
            return $this->redirectToRoute('admin.crud');
        }

        return $this->render('Evenement/editEvent.html.twig', [
            'evenement' => $event,
            'formModifEvent' => $formModifEvent->createView()
        ]);
    }
    
}

?>