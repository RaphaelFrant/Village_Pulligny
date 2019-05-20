<?php

namespace App\Controller\admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Picture;

/**
 * Classe permettant la gestion des images lors de la création ou de la modification des événements
 * @Route("/admin/picture")
 */
class AdminPictureController extends AbstractController{

    /**
     * @Route("/{id}", name="admin.picture.suppr", methods="DELETE")
     */
    public function suppression(Picture $picture, Request $request){

        $eventId = $picture->getEvenement()->getId();
        if($this->isCsrfTokenValid('delete' . $picture->getId(), $request->request->get('_token'))){
            $managEvent = $this->getDoctrine()->getManager();
            $managEvent->remove($picture);
            $managEvent->flush();
        }
        return $this->redirectToRoute('admin.event.edit', ['id' => $eventId]);

    }

}

?>