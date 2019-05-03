<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController{

    /**
     * @Route("/contact", name="contact", methods="['GET']")
     */
    public function contacter(){
        return $this->render("Contact/contact.html.twig");
    }

    
    /**
     * @Route("/contact", name="contact", methods="['POST']")
     */
    public function contacterPost(){
        return $this->render("Contact/contact.html.twig");
    }
}

?>