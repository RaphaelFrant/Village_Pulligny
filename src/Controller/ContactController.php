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

/**
 * Méthode permettant de gérer la page twig de contact
 */
class ContactController extends AbstractController{



    /**
     * Méthode permettant d'envoyer un message à la boite mail municipale
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param ContactMailer $contactMailer
     * @return Request Retourne la page de contact
     */
    public function contacter(Request $request, ContactMailer $contactMailer){

        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);

        if($formContact->isSubmitted() && $formContact->isValid()){
            //Appel de la méthode d'envoie de mail
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