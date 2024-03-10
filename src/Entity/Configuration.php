<?php

namespace App\Entity;

use App\Repository\ConfigurationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigurationRepository::class)]
class Configuration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomSalle = null;

    #[ORM\Column(length: 255)]
    private ?string $telSalle = null;

    #[ORM\Column(length: 255)]
    private ?string $emailSalle = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseSalle = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $heureOuverture = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $heureFermeture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSalle(): ?string
    {
        return $this->nomSalle;
    }

    public function setNomSalle(string $nomSalle): static
    {
        $this->nomSalle = $nomSalle;

        return $this;
    }

    public function getTelSalle(): ?string
    {
        return $this->telSalle;
    }

    public function setTelSalle(string $telSalle): static
    {
        $this->telSalle = $telSalle;

        return $this;
    }

    public function getEmailSalle(): ?string
    {
        return $this->emailSalle;
    }

    public function setEmailSalle(string $emailSalle): static
    {
        $this->emailSalle = $emailSalle;

        return $this;
    }

    public function getAdresseSalle(): ?string
    {
        return $this->adresseSalle;
    }

    public function setAdresseSalle(string $adresseSalle): static
    {
        $this->adresseSalle = $adresseSalle;

        return $this;
    }

    public function getHeureOuverture(): ?\DateTimeImmutable
    {
        return $this->heureOuverture;
    }

    public function setHeureOuverture(\DateTimeImmutable $heureOuverture): static
    {
        $this->heureOuverture = $heureOuverture;

        return $this;
    }

    public function getHeureFermeture(): ?\DateTimeImmutable
    {
        return $this->heureFermeture;
    }

    public function setHeureFermeture(\DateTimeImmutable $heureFermeture): static
    {
        $this->heureFermeture = $heureFermeture;

        return $this;
    }

}
