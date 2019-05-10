<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ServiceRepository;

/**
 * Classe controller permettant de gérer les pages statiques
 */
class HomeController extends AbstractController{


    /**
     * Méthode permettant de renvoyer la page d'accueil
     * @Route("/", name="home")
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function index(){

        return $this->render("Home/home.html.twig");
        
    }

    /**
     * Méthode permettant de renvoyer la page "Histoire"
     * @Route("/history", name="history")
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function histoire(){
        return $this->render("Home/history.html.twig");
    }

    /**
     * Méthode permettant de renvoyer la page "Services"
     * @Route("/service", name="service")
     * @return Symfony\Component\HttpFoundation\Response;
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