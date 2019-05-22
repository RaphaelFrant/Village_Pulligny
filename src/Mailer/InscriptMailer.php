<?php

namespace App\Mailer;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Inscription;
use Dompdf\Dompdf;

/**
 * Classe permettant de gérer l'envoie de mail avec SwiftMailer
 */
class InscriptMailer extends AbstractController{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }

    public function notify(Inscription $inscription, string $pdf){
        $inscriptEnvoye = (new \Swift_Message('Inscription : ' . $inscription->getEvent()->getTitre()))
            ->setFrom($inscription->getEmail())
            ->setTo('contact@pulligny.fr')
            //Permet de former un mail sous la forme d'un document html
            ->setBody($this->render('Inscription/inscriptMail.html.twig', [
                'inscription' => $inscription
            ]), 'text/html')
            ->attach(\Swift_Attachment::fromPath($pdf));
        $this->mailer->send($inscriptEnvoye);
    }

}