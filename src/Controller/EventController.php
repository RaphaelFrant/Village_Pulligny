<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evenement;
use App\Entity\EvenementRecherche;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EvenementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EvenementRechercheType;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Mailer\InscriptMailer;
use App\Controller\CreaPdfController;

/**
 * Classe controller des événements
 */
class EventController extends AbstractController{

    //VARIABLE
    private $managEvent;
    private $reposit;
    private $pdf;

    public function __construct(CreaPdfController $pdf)
    {
        $this->pdf = $pdf;
    }
    
    /**
     * Méthode permettant d'affichr l'ensemble des événements de la base de données dans la page "Evenement"
     * @Route("/event", name="event")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function event(PaginatorInterface $paginator, Request $request){

        $recherche = new EvenementRecherche();
        $formRecherche = $this->createForm(EvenementRechercheType::class, $recherche);
        $formRecherche->handleRequest($request);

        $reposit = $this->getDoctrine()->getRepository(Evenement::class);
        /*$listEvent = $reposit->findAll();*/
        $listEvent = $paginator->paginate($reposit->eventTous($recherche),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render("Evenement/evenement.html.twig", [
            'current_menu' => 'evenement',
            'listEvent' => $listEvent,
            'formRecherche' => $formRecherche->createView()
        ]);
    }

    /**
     * Méthode permettant d'avoir les détails sur un événement précis
     * @Route("/event/{id}", name="event.detail")
     * @param Evenement $detailEvent
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function detail(Evenement $detailEvent, Request $request, InscriptMailer $inscriptMailer){

        $inscription = new Inscription();
        $inscription->setEvent($detailEvent);
        $formInscript = $this->createForm(InscriptionType::class, $inscription);
        $formInscript->handleRequest($request);

        if($formInscript->isSubmitted() && $formInscript->isValid()){

           
            $pdf = $this->pdf->creaPdf($inscription);

            $inscriptMailer->notify($inscription, $pdf);
            $this->addFlash('success', 'Inscription bien envoyée');
            return $this->redirectToRoute('event.detail', [
                'id' => $detailEvent->getId()
            ]);
        }

        return $this->render("Evenement/evenementDetail.html.twig", [
            'detailEvent' => $detailEvent,
            'formInscript' => $formInscript->createView()
        ]);
    }

    /**
     * Méthode permettant de n'afficher que les événements qui n'ont pas encore eu lieu sur la page "Actualité"
     * @Route("/actu", name="actu")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response;
     */
    public function actu(PaginatorInterface $paginator, Request $request){
        
        $reposit = $this->getDoctrine()->getRepository(Evenement::class);
        //$actualites = $reposit->eventActu();
        $actualites = $paginator->paginate($reposit->eventActu(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render("Evenement/actualite.html.twig", [
            'current_menu' => 'actualite',
            'actualites' => $actualites
        ]);
    }
}

?>