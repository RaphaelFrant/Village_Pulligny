<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Test;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TestRepository;

class TestController extends AbstractController{

    private $managEvent;
    private $reposit;

    public function __contruct(TestRepository $reposit){
        $this->reposit = $reposit;
    }

    /**
     * @Route("/index", name="test.index")
     */
    public function index(){

        $reposit = $this->getDoctrine()->getRepository(Test::class);
        $result = $reposit->findAll();

        /*$placeRest = 10;
        $result = $reposit->vuePlaceRest($placeRest); */

        dump($result);

        return $this->render("Test/index.html.twig", [
            'results' => $result
        ]);
        
    }

    /**
     * @Route("/index/{id}", name="test.show")
     */
    public function show(Test $test){

        return $this->render("Test/show.html.twig", [
            'test' => $test
        ]);
        
    }


}

?>