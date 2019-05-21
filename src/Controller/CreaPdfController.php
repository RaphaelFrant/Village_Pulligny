<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Inscription;
use Dompdf\Dompdf;
use Dompdf\Options;

class CreaPdfController extends AbstractController{

    public function creaPdf(Inscription $inscription){

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
      
        $html = $this->renderView('Inscription/inscription.html.twig', [
            'inscription' => $inscription,
            'titre' => "Inscription"
        ]);
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        // Render the HTML as PDF
        $dompdf->render();

        $output = $dompdf->output();

        $publicDirectory = $this->getParameter('kernel.project_dir'). '\public\PdfInscription';
        $pdfFilePath = $publicDirectory . '\Inscription.pdf';
        
        file_put_contents($pdfFilePath, $output);

        return $pdfFilePath;
    }
    

}    

?>