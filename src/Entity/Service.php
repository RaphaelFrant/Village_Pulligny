<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe service permettant la création d'objet du même type
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
{

    //VARIABLE
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nomJour;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="time")
     */
    private $heureFin;

    //GETTEUR et SETTEUR
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomJour(): ?string
    {
        return $this->nomJour;
    }

    public function setNomJour(string $nomJour): self
    {
        $this->nomJour = $nomJour;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }
}
