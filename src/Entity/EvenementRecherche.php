<?php

namespace App\Entity;

/**
 * Classe permettant à l'utilisateur de rechercher un événement ou une actualité par le biais d'un filtre de date
 */
class EvenementRecherche{

    //VARIABLE
    /**
     * @var date|null
     */
    private $dateMin;

    /**
     * @var date|null
     */
    private $dateMax;
    
    //GETTEUR et SETTEUR
    public function getDateMin(): ?\DateTimeInterface
    {
        return $this->dateMin;
    }

    public function setDateMin(\DateTimeInterface $dateMin): self
    {
        $this->dateMin = $dateMin;

        return $this;
    }

    public function getDateMax(): ?\DateTimeInterface
    {
        return $this->dateMax;
    }

    public function setDateMax(\DateTimeInterface $dateMax): self
    {
        $this->dateMax = $dateMax;

        return $this;
    }

}

