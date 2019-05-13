<?php

namespace App\Entity;

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

