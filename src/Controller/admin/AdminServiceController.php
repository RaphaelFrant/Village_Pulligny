<?php

namespace App\Controller\admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Service;
use App\Repository\ServiceRepository;
use Doctrine\Common\Persistence\ObjectManager;


class AdminServiceController extends AbstractController{

    private $reposit;

    public function __construct(ServiceRepository $reposit, ObjectManager $managEvent){
        $this->reposit = $reposit;
        $this->managEvent = $managEvent;
    }

    /**
     * @Route("/admin/horaire", name="admin.horaire.edit", methods="GET|POST")
     */
    public function modifHoraire(Service $service, Request $request){

        return $this->render('Administration/service/editService.html.twig', [
            'service' => $service
        ]);

    }

}

?>