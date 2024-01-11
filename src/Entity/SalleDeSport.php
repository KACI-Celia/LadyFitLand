<?php

namespace App\Entity;

use App\Repository\SalleDeSportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleDeSportRepository::class)]
class SalleDeSport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_salle = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $telSalle = null;

    #[ORM\Column(length: 70, nullable: true)]
    private ?string $emailSalle = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $heureOuverture = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $heureFermeture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresseSalle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSalle(): ?string
    {
        return $this->nom_salle;
    }

    public function setNomSalle(?string $nom_salle): static
    {
        $this->nom_salle = $nom_salle;

        return $this;
    }

    public function getTelSalle(): ?string
    {
        return $this->telSalle;
    }

    public function setTelSalle(?string $telSalle): static
    {
        $this->telSalle = $telSalle;

        return $this;
    }

    public function getEmailSalle(): ?string
    {
        return $this->emailSalle;
    }

    public function setEmailSalle(?string $emailSalle): static
    {
        $this->emailSalle = $emailSalle;

        return $this;
    }

    public function getHeureOuverture(): ?string
    {
        return $this->heureOuverture;
    }

    public function setHeureOuverture(?string $heureOuverture): static
    {
        $this->heureOuverture = $heureOuverture;

        return $this;
    }

    public function getHeureFermeture(): ?string
    {
        return $this->heureFermeture;
    }

    public function setHeureFermeture(?string $heureFermeture): static
    {
        $this->heureFermeture = $heureFermeture;

        return $this;
    }

    public function getAdresseSalle(): ?string
    {
        return $this->adresseSalle;
    }

    public function setAdresseSalle(?string $adresseSalle): static
    {
        $this->adresseSalle = $adresseSalle;

        return $this;
    }
}
