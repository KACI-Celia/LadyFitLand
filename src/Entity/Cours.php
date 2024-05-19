<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'Cours')]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'Cours')]
    private ?Espaces $espaces = null;

    #[ORM\OneToMany(mappedBy: 'Cours', targetEntity: Reservation::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addCour($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeCour($this);
        }

        return $this;
    }

    public function getEspaces(): ?Espaces
    {
        return $this->espaces;
    }

    public function setEspaces(?Espaces $espaces): static
    {
        $this->espaces = $espaces;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setCours($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getCours() === $this) {
                $reservation->setCours(null);
            }
        }

        return $this;
    }
}
