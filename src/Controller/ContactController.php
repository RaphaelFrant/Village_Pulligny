<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use Doctrine\Common\Persistence\ObjectManager;

class ContactController extends AbstractController{

    /**
     * @Route("/contact", name="contact")
     */
    public function contacter(Request $request){

        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);


        return $this->render("Contact/contact.html.twig", [
            'formContact' => $formContact->createView()
        ]);
    }
}

?>