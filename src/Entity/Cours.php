<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
#[Broadcast]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70, nullable: true)]
    private ?string $libCours = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $dateDebut = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $dateFin = null;

    #[ORM\Column(length: 8, nullable: true)]
    private ?string $heureDebut = null;

    #[ORM\Column(length: 8, nullable: true)]
    private ?string $heureFin = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $quantiteParticipant = null;

    #[ORM\Column(length: 250, nullable: true)]
    private ?string $coach = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $instructions = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibCours(): ?string
    {
        return $this->libCours;
    }

    public function setLibCours(?string $libCours): static
    {
        $this->libCours = $libCours;

        return $this;
    }

    public function getDateDebut(): ?string
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?string $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?string
    {
        return $this->dateFin;
    }

    public function setDateFin(?string $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getHeureDebut(): ?string
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(?string $heureDebut): static
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?string
    {
        return $this->heureFin;
    }

    public function setHeureFin(?string $heureFin): static
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getQuantiteParticipant(): ?string
    {
        return $this->quantiteParticipant;
    }

    public function setQuantiteParticipant(?string $quantiteParticipant): static
    {
        $this->quantiteParticipant = $quantiteParticipant;

        return $this;
    }

    public function getCoach(): ?string
    {
        return $this->coach;
    }

    public function setCoach(?string $coach): static
    {
        $this->coach = $coach;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(?string $instructions): static
    {
        $this->instructions = $instructions;

        return $this;
    }
}
