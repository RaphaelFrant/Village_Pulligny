<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Service;
use Symfony\Component\HttpFoundation\Request;
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

        return $this->render("Home/home.html.twig", [
            'current_menu' => 'accueil'
        ]);
        
    }

    /**
     * Méthode permettant de renvoyer la page "Histoire"
     * @Route("/history", name="history")
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function histoire(){
        return $this->render("Home/history.html.twig", [
            'current_menu' => 'histoire'
        ]);
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
            'current_menu' => 'service',
            'horaireList' => $horaireList
        ]); 
    }

    /**
     * Méthode permettant de renvoyer la page "Données Personnelles"
     * @Route("/donneesPerso", name="donneesPerso")
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function donneesPerso(){
        return $this->render("Home/donneesPerso.html.twig");
    }

    /**
     * Méthode permettant de changer de langue
     * @Route("/langue/{lang}", name="langue")
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function langue(Request $request, string $lang){

        if($lang != null){
            $this->get('session')->set('_locale', $lang);
        }

        $url = $request->headers->get('referer');
        if(empty($url)){
            $url = $this->container->get('router')->generate('index');
        }
        return $this->redirect($url);
    }

}

?>