<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ServiceRepository;

class HomeController extends AbstractController{


    /**
     * @Route("/", name="home")
     */
    public function index(){

        return $this->render("Home/home.html.twig");
        
    }

    /**
     * @Route("/history", name="history")
     */
    public function histoire(){
        return $this->render("Home/history.html.twig");
    }

    /**
     * @Route("/service", name="service")
     */
    public function service(){

        $reposit = $this->getDoctrine()->getRepository(Service::class);
        $horaireList = $reposit->findAll();
    
        return $this->render("Home/service.html.twig", [
            'horaireList' => $horaireList
        ]); 
    }

}

?>