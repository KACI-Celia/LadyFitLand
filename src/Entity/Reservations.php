<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelleReservation = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $heureDebut = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $heureFin = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $jourDebut = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $jourFin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleReservation(): ?string
    {
        return $this->libelleReservation;
    }

    public function setLibelleReservation(?string $libelleReservation): static
    {
        $this->libelleReservation = $libelleReservation;

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

    public function getJourDebut(): ?string
    {
        return $this->jourDebut;
    }

    public function setJourDebut(?string $jourDebut): static
    {
        $this->jourDebut = $jourDebut;

        return $this;
    }

    public function getJourFin(): ?string
    {
        return $this->jourFin;
    }

    public function setJourFin(?string $jourFin): static
    {
        $this->jourFin = $jourFin;

        return $this;
    }
}
