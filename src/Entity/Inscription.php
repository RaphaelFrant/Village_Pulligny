<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Classe Inscription permettant la création d'objet du même type
 */
class Inscription {

    //VARIABLE
    /**
     * @var string
     * @Assert\NotNull
     * @Assert\Length(min=2, max=30)
     */
    private $nom;

    /**
     * @var string
     * @Assert\NotNull
     * @Assert\Length(min=2, max=30)
     */
    private $prenom;

    /**
     * @var string
     * @Assert\NotNull
     * @Assert\Email()
     */
    private $email;

    /**
     * @var Evenement
     */
    private $event;


    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of event
     *
     * @return  Evenement
     */ 
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set the value of event
     *
     * @param  Evenement  $event
     *
     * @return  self
     */ 
    public function setEvent(Evenement $event)
    {
        $this->event = $event;

        return $this;
    }
}

?>