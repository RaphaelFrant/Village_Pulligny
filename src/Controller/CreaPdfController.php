<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Response;
use App\Entity\Inscription;
use Dompdf\Dompdf;
use Dompdf\Options;


/**
 * Classe permettant la création d'un document pdf avec les informations rentrées pour une inscription
 */
class CreaPdfController extends AbstractController{

    /**
     * Fonction permettant la création d'un pdf à partir d'information liée à l'inscription
     */
    public function creaPdf(Inscription $inscription){

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
      
        $html = $this->renderView('Inscription/inscription.html.twig', [
            'title' => "Inscription", 
            'inscription' => $inscription
        ]);
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();

        $output = $dompdf->output();

        $publicDirectory = $this->getParameter('kernel.project_dir'). '/public/pdfinscription';
        $pdfFilePath = $publicDirectory . '/inscription.pdf';
        
        file_put_contents($pdfFilePath, $output);

        return $pdfFilePath;
    }
    

}    

?>