<?php

namespace App\Controller\admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Classe permettant la gestion des pages concernant la gestion des horaires en administrateur
 */
class AdminServiceController extends AbstractController{

    //VARIABLE
    private $reposit;

    /**
     * Méthode de construction de la classe
     * @param EvenementRepository $reposit
     * @param ObjectManager $managEvent
     */
    public function __construct(ServiceRepository $reposit, ObjectManager $managEvent){
        $this->reposit = $reposit;
        $this->managEvent = $managEvent;
    }

    /**
     * Méthode permettant de modifier les horaires d'ouverture de la mairie
     * @Route("/admin/horaire/{id}", name="admin.horaire.edit")
     * @param Service $service
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function modifHoraire(Service $service, Request $request){

        $formModifHeure = $this->createForm(ServiceType::class, $service);
        $formModifHeure->handleRequest($request);

        if($formModifHeure->isSubmitted() && $formModifHeure->isValid()){
            $this->managEvent->flush();
            $this->addFlash('success', 'Horaire bien modifié.');
            return $this->redirectToRoute('service');
        }

        return $this->render('Administration/service/editService.html.twig', [
            'service' => $service,
            'formModifHeure' => $formModifHeure->createView()
        ]);

    }

}

?>