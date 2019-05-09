<?php

namespace App\Mailer;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;

class ContactMailer extends AbstractController{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }

    public function notify(Contact $contact){
        $messageEnvoye = (new \Swift_Message('Contact'))
            ->setFrom($contact->getEmail())
            ->setTo('contact@pulligny.fr')
            ->setBody($this->render('Contact/retourMail.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($messageEnvoye);
    }


}

?>