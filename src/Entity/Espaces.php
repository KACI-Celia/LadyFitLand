<?php

namespace App\Entity;

use App\Repository\EspacesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspacesRepository::class)]
class Espaces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelleEspace = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionEspace = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'Espaces')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'espaces', targetEntity: Cours::class)]
    private Collection $Cours;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->Cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleEspace(): ?string
    {
        return $this->libelleEspace;
    }

    public function setLibelleEspace(?string $libelleEspace): static
    {
        $this->libelleEspace = $libelleEspace;

        return $this;
    }

    public function getDescriptionEspace(): ?string
    {
        return $this->descriptionEspace;
    }

    public function setDescriptionEspace(?string $descriptionEspace): static
    {
        $this->descriptionEspace = $descriptionEspace;

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
            $user->addEspace($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeEspace($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->Cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->Cours->contains($cour)) {
            $this->Cours->add($cour);
            $cour->setEspaces($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->Cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getEspaces() === $this) {
                $cour->setEspaces(null);
            }
        }

        return $this;
    }
}
