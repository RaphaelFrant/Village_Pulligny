<?php

namespace App\Mailer;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;

/**
 * Classe permettant de gérer l'envoie de mail avec SwiftMailer
 */
class ContactMailer extends AbstractController{

    //VARIABLE
    private $mailer;

    /**
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }

    /**
     * Méthode permettant de gérer l'envoie d'un mail vers la boite mail de la mairie
     * @param Contact $contact
     * @return Symfony\Component\HttpFoundation\Response; 
     */
    public function notify(Contact $contact){
        $messageEnvoye = (new \Swift_Message('Contact'))
            ->setFrom($contact->getEmail())
            ->setTo('contact@pulligny.fr')
            //Permet de former un mail sous la forme d'un document html
            ->setBody($this->render('Contact/retourMail.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($messageEnvoye);
    }


}

?>