<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Test;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TestRepository;

class HomeController extends AbstractController{

    /*private $managEvent;
    private $reposit;

    public function __contruct(TestRepository $reposit){
        $this->reposit = $reposit;
    }*/

    /**
     * @Route("/", name="home")
     */
    public function index(){

        /*$reposit = $this->getDoctrine()->getRepository(Test::class);
        $result = $reposit->findAll();*/

        /*$placeRest = 10;
        $result = $reposit->vuePlaceRest($placeRest); 

        dump($result);*/

        /*return $this->render("Home/home.html.twig", [
            'results' => $result
        ]);*/

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
        return $this->render("Home/service.html.twig");
    }

}

?>