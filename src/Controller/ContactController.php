<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use Doctrine\Common\Persistence\ObjectManager;
use App\Mailer\ContactMailer;

class ContactController extends AbstractController{


    //private $contactMailer;

    /**
     * @Route("/contact", name="contact")
     */
    public function contacter(Request $request, ContactMailer $contactMailer){

        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);

        if($formContact->isSubmitted() && $formContact->isValid()){
            $contactMailer->notify($contact);
            $this->addFlash('success', 'Message bien envoyé');
            return $this->redirectToRoute("contact");
        }


        return $this->render("Contact/contact.html.twig", [
            'formContact' => $formContact->createView()
        ]);
    }
}

?>